<?php

namespace App\Models;

use App\Enums\ApplicationStatus;
use App\Filters\UserFilters;
use App\Jobs\ApplicantStatusUpdateToHubspotJob;
use App\Mail\ContractPdfSend;
use App\Mail\GovernmentStudySheetSubmit;
use App\Notifications\PasswordReset as NotificationsPasswordReset;
use App\Notifications\SelectionTestResult;
use App\Traits\Mediable;
use App\Traits\User\ContractPdf;
use App\Traits\User\SelectionTestPdf;
use App\Traits\User\UserRelations;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;
use Plank\Metable\Metable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements ContractsAuditable
{
    use AuditingAuditable,
        SoftDeletes,
        HasApiTokens,
        HasFactory,
        HasProfilePhoto,
        Notifiable,
        TwoFactorAuthenticatable,
        Mediable,
        HasRoles,
        UserRelations,
        SelectionTestPdf,
        Metable,
        ContractPdf;

    public const GENDER_MALE = 'male';

    public const GENDER_FEMALE = 'female';

    public const GENDER_OTHER = 'other';

    const SEARCHABLE_FIELDS = ['first_name', 'last_name', 'email', 'phone', 'created_at'];

    protected $fillable = [
        'application_status', 'first_name', 'last_name', 'phone', 'email', 'password', 'profile_photo_path',
        'cubia_id', 'is_active', 'locale', 'show_application_on_marketplace_at',
    ];

    protected $hidden = [
        'password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'show_application_on_marketplace_at' => 'datetime',
        'competency_catch_up' => 'boolean',
        'is_active' => 'boolean',
        'application_status' => ApplicationStatus::class,
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected array $auditInclude = [
        'application_status',
        'competency_catch_up',
    ];

    protected static function boot(): void
    {
        parent::boot();

        self::created(function ($model) {
            $model->last_data_updated_at = Carbon::now();
        });

        self::updating(function ($model) {
            $model->last_data_updated_at = Carbon::now();
        });

        self::deleted(function ($model) {
            $model->last_data_updated_at = Carbon::now();
            $model->save();
        });
    }

    protected function fullName(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            return collect([$attributes['first_name'], $attributes['last_name']])->filter()->implode(' ');
        });
    }

    protected function applicationStatus(): Attribute
    {
        return Attribute::set(function ($value, $attributes) {
            if (app()->environment('production') && $this->hubspotConfiguration()->exists()) {
                ApplicantStatusUpdateToHubspotJob::dispatch($this, $value);
            }

            return $value;
        });
    }

    public function hasExamPassed(): bool
    {
        $this->load('results');
        $statusId = $this->application_status?->id();
        $resultsCount = $this->results->count();
        $passedResultsCount = $this->results->where('is_passed', true)->count();

        return
            $statusId == 4 ||
            $statusId >= 9 ||
            ($statusId == ApplicationStatus::TEST_RESULT_PDF_RETRIEVED_ON && $resultsCount == $passedResultsCount);
    }

    public function scopeFilter($query)
    {
        return resolve(UserFilters::class)->apply($query);
    }

    public function scopeSearchByKey($query, $key, $keyword)
    {
        if ($key && $keyword) {
            return $query->where($key, 'like', "%$keyword%");
        }
    }

    public function scopeCoursesIn($query, $courseIds = [])
    {
        return $query->whereHas('courses', function ($query) use ($courseIds) {
            $query->whereIn('course_id', $courseIds);
        });
    }

    public function scopeHasConsentToCompanyPortalBulletinBoard($query)
    {
        return $query->whereIn('application_status', [
            ApplicationStatus::APPLIED_ON_MARKETPLACE,
            ApplicationStatus::APPLYING_TO_SELECTED_COMPANY,
            ApplicationStatus::APPLIED_TO_SELECTED_COMPANY,
        ]);
    }

    public function getValueByField($fieldKey)
    {
        if ($fieldKey) {
            return $this->values()->searchByField($fieldKey)->first();
        }
    }

    public function getEctsPointvalue($identifier)
    {
        return $this->values->filter(function ($item) use ($identifier) {
            return $item->fields->key == $identifier;
        })->first()?->value;
    }

    public function saveCubiaId()
    {
        $this->cubia_id = Str::random(10);

        $this->save();
    }

    public function saveMeteorId()
    {
        Meteor::create([
            'user_id' => $this->id,
            'na_tan' => Str::random(10),
        ]);
    }

    public function isSelectionTestingMode(): bool
    {
        return $this->application_status->applicationStatusOrder() >= ApplicationStatus::PROFILE_INFORMATION_COMPLETED->applicationStatusOrder();
    }

    public function updateApplicationStatusForTestResult()
    {
        if ($this->application_status->id() > ApplicationStatus::TEST_RESULT_PDF_RETRIEVED_ON->id()) {
            return;
        }

        $results = Result::myResults($this)
            ->join('tests', 'tests.id', '=', 'results.test_id')
            ->select(['tests.category', 'results.status', 'results.is_passed', 'results.user_id', 'results.failed_by_nak'])
            ->get();

        $firstCategoryResults = $results->where('category', Test::FIRST_CATEGORY);
        $secondCategoryResults = $results->where('category', Test::SECOND_CATEGORY);

        $updatedStatusResults = $results
            ->whereNotIn('status', [Result::STATUS_NOT_STARTED, Result::STATUS_STARTED]);

        // Passed in exam
        if ($firstCategoryResults->where('is_passed', true)->count()
            && $secondCategoryResults->where('is_passed', true)->count()) {
            if(! $this->hasMeta('test_completed_at')){
                $this->applicantPassedSelectionTest();
            }

            $this->setMeta('test_completed_at', now());

            return;
        }

        // Failed in exam
        if (($updatedStatusResults->count() === $results->count())
            && ($firstCategoryResults->where('is_passed', true)->isEmpty()
                || $secondCategoryResults->where('is_passed', true)->isEmpty())) {
            $this->application_status = \App\Enums\ApplicationStatus::TEST_FAILED;
            $this->save();
        }
    }

    public function applicantPassedSelectionTest()
    {
        $this->application_status = \App\Enums\ApplicationStatus::TEST_PASSED;
        $this->save();

        $this->notify(new SelectionTestResult($this));
        $this->savePassedPdf();
    }

    public function applicantFailedSelectionTest()
    {
        $this->application_status = \App\Enums\ApplicationStatus::TEST_FAILED_CONFIRM;
        $this->save();

        $this->notify(new SelectionTestResult($this));
        $this->saveFailedPdf();
    }

    public function hubspotConfigurationUpdated()
    {
        $this->load('hubspotConfiguration');
        if ($this->hubspotConfiguration()->exists()) {
            $this->hubspotConfiguration->updateUserUpdatedAt();
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new NotificationsPasswordReset($token, request()->email));
    }

    public function attachCourseWithDesiredBeginning($desiredBeginning, array $course_ids)
    {
        $desiredBeginning = $this->desiredBeginning()
            ->updateOrCreate(['course_start_date' => $desiredBeginning]);
        $desiredBeginning->courses()->sync($course_ids);
    }

    public function enrollApplicant()
    {
        if ($this->application_status->id() < ApplicationStatus::ENROLLMENT_ON->id() && $this->government_form?->is_submit == true && $this->study_sheet?->is_submit == true) {
            Mail::to(config('mail.supporter.address'))->send(new GovernmentStudySheetSubmit($this));
            $this->application_status = ApplicationStatus::ENROLLMENT_ON;

            $this->saveContractPdf();

            Mail::to($this)->send(new ContractPdfSend($this));

            $this->save();
        }
    }

    public function coursesName()
    {
        return $this->courses()->with('course')->get()->pluck('course.name');
    }

    public function testResultBarcode()
    {
        return base64_encode(\QrCode::format('svg')
            ->size(200)
            ->generate(route('applicant.test-result', ['hash' => base64_encode($this->email)])));
    }
}
