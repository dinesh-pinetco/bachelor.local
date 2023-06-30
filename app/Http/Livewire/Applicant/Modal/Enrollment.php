<?php

namespace App\Http\Livewire\Applicant\Modal;

use App\Http\Livewire\Traits\HasModal;
use App\Jobs\FetchSannaCompaniesJob;
use App\Mail\ApplicantEnrolled;
use App\Models\Company;
use App\Models\CompanyContacts;
use App\Models\Course;
use App\Models\Field;
use App\Models\FieldValue;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Enrollment extends Component
{
    use HasModal;

    public User $applicant;

    public $selectedCompany;

    public $selectedCompanyContacts;

    public $courses = [];

    public bool $isEdit = false;

    public $date_of_birth;

    public $desiredBeginning;

    public $companies = [];

    public $companyContacts = [];

    public $partnerCompanyFieldId;

    public ?int $partnerCompanyContactFieldId;

    public $applicantCourse;

    public $enrollCourse;

    public $enrolledOutsideSystem = false;

    protected function rules()
    {
        $rules = [
            'applicantCourse' => ['required'],
            'selectedCompanyContacts' => ['required'],
        ];

        $rules = array_merge($this->enrolledOutsideSystem ? [
            'selectedCompany' => ['required', 'alpha', 'min:1', 'max:255'],
            'selectedCompanyContacts' => ['required', 'alpha', 'min:1', 'max:255'],
        ] : [
            'selectedCompany' => ['required', 'exists:companies,id'],
            'selectedCompanyContacts.*' => ['required', 'exists:company_contacts,id'],
        ], $rules);

        return $rules;
    }

    public function mount()
    {
        $this->companies = Company::getFromCache();

    }

    public function toggle(User $user)
    {
        if (! auth()->user()->hasRole(ROLE_APPLICANT)) {

            $this->partnerCompanyFieldId = Field::where('key', 'enroll_company')->first()?->id;
            $this->partnerCompanyContactFieldId = Field::where('key', 'enroll_company_contact')->first()?->id;
            $this->enrollCourse = Field::where('key', 'enroll_course')->first()?->id;
        }

        $this->show = ! $this->show;
        $this->applicant = $user;
        $this->applicant->load('configuration');
        $this->date_of_birth = $this->applicant?->values->where('fields.key', 'date_of_birth')->value('value');
        $this->desiredBeginning = $this->applicant?->selectedDesiredBeginning->course_start_date->translatedFormat('F.Y');
        $courseIds = $this->applicant->getValueByField('course_id')?->value;
        $this->courses = Course::whereIn('id', json_decode($courseIds))->get();
        $this->enrolledOutsideSystem = $this->applicant->configuration?->is_enrolled_outside_system;

        $this->selectedCompany = $this->applicant->getValueByField('enroll_company')?->value;

        $this->applicantCourse = $this->applicant->getValueByField('enroll_course')?->value;

        if ($this->selectedCompany) {
            $this->companyContacts = CompanyContacts::where('company_id', $this->selectedCompany)->get();

            $this->selectedCompanyContacts = $this->applicant->getValueByField('enroll_company_contact')?->value;
        }
    }

    public function syncCompanies()
    {
        FetchSannaCompaniesJob::dispatch();

        $this->reset(['selectedCompanyContacts', 'selectedCompany']);
    }

    public function updatedSelectedCompany($value)
    {
        if (! $this->enrolledOutsideSystem) {
            $this->companyContacts = $value
                ? collect($this->companies)->where('id', $value)->first()->contacts
                : [];

            $this->selectedCompanyContacts = null;
        }
    }

    public function updatedEnrolledOutsideSystem($value)
    {
        $this->reset(['selectedCompanyContacts', 'selectedCompany']);
    }

    public function enroll()
    {

        $this->validate();

        $this->applicant->configuration()->update([
            'is_enrolled_outside_system' => $this->enrolledOutsideSystem,
        ]);

        $enrollApplicantCourse = FieldValue::updateOrCreate([
            'user_id' => $this->applicant->id,
            'field_id' => $this->enrollCourse,
        ], [
            'value' => $this->applicantCourse,
        ]);

        $company = FieldValue::updateOrCreate([
            'user_id' => $this->applicant->id,
            'field_id' => $this->partnerCompanyFieldId,
        ], [
            'value' => $this->selectedCompany,
        ]);

        $companyContacts = FieldValue::updateOrCreate([
            'user_id' => $this->applicant->id,
            'field_id' => $this->partnerCompanyContactFieldId,
        ], [
            'value' => $this->selectedCompanyContacts,
        ]);

        $this->applicant->setMeta('enrollment_at', now());

        if ($company->wasRecentlyCreated && $companyContacts->wasRecentlyCreated) {
            Mail::to($this->applicant)->bcc(config('mail.supporter.address'))->send(new ApplicantEnrolled($this->applicant, $this->applicantCourse));
        }

        $this->emitUp('refresh');
        $this->close();

        $this->toastNotify(__('Applicant has been enrolled successfully.'));
    }

    public function render()
    {
        return view('livewire.applicant.modal.enrollment');
    }
}
