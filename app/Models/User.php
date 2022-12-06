<?php

namespace App\Models;

use App\Enums\ApplicationStatus;
use App\Filters\UserFilters;
use App\Jobs\ApplicantStatusUpdateToHubspotJob;
use App\Notifications\PasswordReset as NotificationsPasswordReset;
use App\Notifications\SelectionTestResult;
use App\Traits\Mediable;
use App\Traits\User\SelectionTestPdf;
use App\Traits\User\UserRelations;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;
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
        SelectionTestPdf;

    public const GENDER_MALE = 'male';

    public const GENDER_FEMALE = 'female';

    public const GENDER_OTHER = 'other';

    const SEARCHABLE_FIELDS = ['first_name', 'last_name', 'email', 'phone', 'created_at'];

    protected $fillable = [
        'application_status', 'first_name', 'last_name', 'phone', 'email', 'password', 'profile_photo_path',
        'cubia_id',
    ];

    protected $hidden = [
        'password', 'remember_token', 'two_factor_recovery_codes', 'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
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

    public function isTestPassed()
    {
        return $this->application_status->applicationStatusOrder() >= ApplicationStatus::TEST_FAILED->applicationStatusOrder();
    }

    public function saveApplicationStatus()
    {
        $results = Result::myResults($this)
            ->select(['status', 'is_passed', 'user_id', 'failed_by_nak'])
            ->get();

        $totalTests = $results->count();
        if ($totalTests == $results->where('is_passed', true)->count()) {
            $this->applicantPassedSelectionTest();
        }
        if ($totalTests == $results->where('is_passed', false)->where('failed_by_nak', true)->count()) {
            $this->applicantFailedSelectionTest();
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
        $desiredBeginning = $this->desiredBeginning()->create(['course_start_date' => $desiredBeginning]);
        $desiredBeginning->courses()->attach($course_ids);
    }

    public function coursesName()
    {
        return $this->courses()->with('course')->get()->pluck('course.name');
    }
}
