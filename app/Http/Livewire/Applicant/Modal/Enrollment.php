<?php

namespace App\Http\Livewire\Applicant\Modal;

use App\Http\Livewire\Traits\HasModal;
use App\Mail\ApplicantEnrolled;
use App\Models\Company;
use App\Models\CompanyContacts;
use App\Models\Field;
use App\Models\FieldValue;
use App\Models\User;
use App\Services\Companies\Companies;
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
        $this->fetchCompanies();

        $this->partnerCompanyFieldId = Field::where('label', 'Partner company')->first()?->id;
        $this->partnerCompanyContactFieldId = Field::where('label', 'Partner company contacts')->first()?->id;
        $this->enrollCourse = Field::where('label', 'Enroll Course')->first()?->id;
    }

    protected function fetchCompanies()
    {
        $this->companies = Company::with('contacts')->get();
    }

    public function toggle(User $user)
    {
        $this->show = ! $this->show;
        $this->applicant = $user;
        $this->applicant->load('configuration');
        $this->date_of_birth = $this->applicant?->values->where('fields.key', 'date_of_birth')->value('value');
        $this->desiredBeginning = $this->applicant?->desiredBeginning->course_start_date->translatedFormat('F.Y');
        $this->courses = $this->applicant->courses()->with('course')->get();
        $this->enrolledOutsideSystem = $this->applicant->configuration->is_enrolled_outside_system;

        $this->selectedCompany = FieldValue::where('field_id', $this->partnerCompanyFieldId)
            ->where('user_id', $this->applicant->id)
            ->first()
            ?->value;

        $this->applicantCourse = FieldValue::where('field_id', $this->enrollCourse)
            ->where('user_id', $this->applicant->id)
            ->first()?->value;

        if ($this->selectedCompany) {
            $this->companyContacts = CompanyContacts::where('company_id', $this->selectedCompany)->get();

            $this->selectedCompanyContacts = FieldValue::where('field_id', $this->partnerCompanyContactFieldId)
                ->where('user_id', $this->applicant->id)
                ->first()
                ?->value;
        }
    }

    public function syncCompanies()
    {
        Companies::make()->sync();
        $this->fetchCompanies();

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

        if ($company->wasRecentlyCreated && $companyContacts->wasRecentlyCreated) {
            Mail::to($this->applicant)->bcc(config('mail.supporter.address'))->send(new ApplicantEnrolled($this->applicant));
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
