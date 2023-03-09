<?php

namespace App\Traits;

use Illuminate\Validation\Rule;

trait StudySheetFormValidations
{
    protected function rules(): array
    {
        return [
            'studySheet.place_of_birth' => ['required'],
            'studySheet.country_of_birth' => ['required'],
            'studySheet.nationality_first' => ['required'],
            'studySheet.nationality_second' => ['nullable'],
            'studySheet.student_id_card_photo' => ['required'],
            'studySheet.have_health_insurance' => ['nullable'],
            'studySheet.is_health_insurance_private' => ['nullable'],
            'studySheet.health_insurance_company_id' => [Rule::when($this->studySheet->have_health_insurance && ! $this->studySheet->is_health_insurance_private, 'exists:health_insurance_companies,id')],
            //            'studySheet.health_insurance_company_id' => ['required_if:studySheet.have_health_insurance,1', 'nullable', 'exists:health_insurance_companies,id'],
            'studySheet.health_insurance_number' => [Rule::when($this->studySheet->have_health_insurance && ! $this->studySheet->is_health_insurance_private, ['regex:/[A-Z]{1}[0-9]{9}/u', 'min:10', 'max:10'])],
            //            'studySheet.health_insurance_number' => [Rule::requiredIf($this->studySheet->have_health_insurance && !$this->studySheet->is_health_insurance_private),'regex:/[A-Z]{1}[0-9]{9}/u', 'min:10', 'max:10'],
            'studySheet.school' => ['nullable', 'string'],
            'studySheet.phone' => ['required', 'regex:/[0-9]/u'],
            'studySheet.address' => ['nullable'],
            'studySheet.street' => ['required'],
            'studySheet.zip' => ['required'],
            'studySheet.place' => ['required'],
            'studySheet.secondary_language' => ['nullable'],
            'studySheet.privacy_policy' => ['required', 'accepted'],
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'studySheet.date_of_birth' => __('Date of Birth'),
            'studySheet.place_of_birth' => __('Place of Birth'),
            'studySheet.country_of_birth' => __('Country of birth'),
            'studySheet.nationality_first' => __('Nationality first'),
            'studySheet.nationality_second' => __('Nationality second'),
            'studySheet.student_id_card_photo' => __('Student card photo'),
            'studySheet.health_insurance_company_id' => __('Health insurance company'),
            'studySheet.health_insurance_number' => __('Health insurance number'),
            'studySheet.school' => __('School'),
            'studySheet.phone' => __('Phone'),
            'studySheet.address' => __('Address'),
            'studySheet.street' => __('Street'),
            'studySheet.zip' => __('Zip'),
            'studySheet.place' => __('Place'),
            'studySheet.privacy_policy' => __('Privacy Policy'),
        ];
    }

    protected function messages(): array
    {
        return [

            'studySheet.health_insurance_number.regex' => __('Please note the correct format (e.g L123456789)'),
            'studySheet.phone.regex' => __('The Phone must be Numeric'),
            'studySheet.health_insurance_company_id.required_if' => __('The Health insurance Company must select if you have insurance'),
            'studySheet.health_insurance_number.required_if' => __('The Health insurance number must select if you have insurance'),
        ];
    }
}
