<?php

namespace App\Http\Livewire;

use App\Mail\GovernmentStudySheetSubmit;
use App\Models\HealthInsuranceCompany;
use App\Models\Nationality;
use App\Models\StudySheet as StudySheetModel;
use App\Traits\StudySheetFormValidations;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class StudySheet extends Component
{
    use StudySheetFormValidations;

    public $applicant;

    public StudySheetModel $studySheet;

    public bool $formAlreadySubmitted = false;

    public bool $isGermanUser = false;

    public bool $paymentOptionDisabled = false;

    private string $paymentOptionDisableCompany = 'CGI';

    public function mount()
    {
        $countryOfBirth = $this->applicant->getValueByField('nationality_id');
        if ($countryOfBirth) {
            $germanCountry = Nationality::where('name', 'Deutschland')->first();
            $this->isGermanUser = $countryOfBirth->value == $germanCountry->id;
        }

        $this->studySheet = $this->applicant->study_sheet ?? new StudySheetModel();

        if (! $this->applicant->study_sheet) {
            $this->studySheet->billing_address = 1;
        }

        $this->formAlreadySubmitted = $this->studySheet->is_submit ?? false;
        $this->paymentOptionDisabled();
    }

    public function getHealthInsuranceCompaniesProperty(): Collection
    {
        return HealthInsuranceCompany::active()->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->paymentOptionDisabled();

        $this->studySheet->billing_address = $this->studySheet->billing_address ?: null;
        $this->studySheet->health_insurance_type = $this->studySheet->health_insurance_type ?: null;
        $this->studySheet->health_insurance_company_id = $this->studySheet->health_insurance_company_id ?: null;

        if ($this->studySheet->billing_address == StudySheetModel::ADDRESS_MAIN_ADDRESS) {
            $this->studySheet->custom_billing_address = null;
        }

        if ($this->studySheet->health_insurance_type == StudySheetModel::HEALTH_INSURANCE_PRIVATE) {
            $this->validateOnly('health_insurance_number');
            $this->validateOnly('health_insurance_company_id');
            $this->validateOnly('health_insurance_company');
            $this->studySheet->health_insurance_number = null;
            $this->studySheet->health_insurance_company_id = null;
            $this->studySheet->health_insurance_company = null;
        }
        if ($this->studySheet->health_insurance_company_id != StudySheetModel::HEALTH_INSURANCE_OTHER) {
            $this->studySheet->health_insurance_company = null;
        }

        $this->save();
    }

    public function save()
    {
        if ($this->applicant->study_sheet == null) {
            $this->applicant->study_sheet()->save($this->studySheet);
        } else {
            $this->studySheet->save();
        }
    }

    public function submit()
    {
        $this->validate($this->rules());

        $this->studySheet->is_submit = true;
        $this->studySheet->save();

        $this->applicant->load(['government_form', 'study_sheet']);

        if ($this->applicant->government_form?->is_submit && $this->applicant->study_sheet?->is_submit) {
            Mail::to(config('mail.supporter.address'))->send(new GovernmentStudySheetSubmit($this->applicant));
        }

        $this->toastNotify(__('Information saved successfully.'), __('Success'), TOAST_SUCCESS);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.study-sheet');
    }

    public function paymentOptionDisabled(): void
    {
        if ($this->studySheet->billing_address == 2 && data_get($this->studySheet->custom_billing_address, 'name') == $this->paymentOptionDisableCompany) {
            $this->paymentOptionDisabled = true;
        } else {
            $this->paymentOptionDisabled = false;
        }
    }
}
