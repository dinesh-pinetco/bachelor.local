<?php

namespace App\Traits;

use App\Models\StudySheet as StudySheetModel;
use Illuminate\Validation\Rule;

trait StudySheetFormValidations
{
    protected function rules(): array
    {
        $specificCompanyPaymentValidation = 'nullable';

        $ibanValidation = [$specificCompanyPaymentValidation];
        if (data_get($this->studySheet->custom_billing_address, 'name') != $this->paymentOptionDisableCompany) {
            $ibanValidation = $this->isGermanUser ? [$specificCompanyPaymentValidation,
                'regex:/DE [0-9]{2} [0-9A-Za-z]/u', 'max:30', ]
                : [$specificCompanyPaymentValidation, 'regex:/[A-Z]{2} [0-9]{2} [0-9A-Za-z]/u', 'max:30'];
        }

        return [
            'studySheet.billing_address' => ['required', Rule::in(StudySheetModel::address())],
            'studySheet.custom_billing_address' => ['required_if:studySheet.billing_address,2',
                'nullable', 'array', 'max:6', ],
            'studySheet.custom_billing_address.name' => ['required_if:studySheet.billing_address,2',
                'nullable', 'max:100', ],
            'studySheet.custom_billing_address.address' => ['required_if:studySheet.billing_address,2',
                'max:255', ],
            'studySheet.custom_billing_address.postal_code' => ['required_if:studySheet.billing_address,2',
                'max:50', ],
            'studySheet.custom_billing_address.location' => ['required_if:studySheet.billing_address,2',
                'max:100', ],
            'studySheet.custom_billing_address.address_suffix' => ['nullable', 'max:20'],
            'studySheet.custom_billing_address.country' => ['required_if:studySheet.billing_address,2',
                'max:50', ],

            'studySheet.health_insurance_type' => ['required', Rule::in(StudySheetModel::healthInsuranceTypes())],
            'studySheet.health_insurance_number' => ['required_if:studySheet.health_insurance_type,1', 'nullable', 'regex:/[A-Z]{1}[0-9]{9}/u', 'min:10', 'max:10'],
            'studySheet.health_insurance_company_id' => ['required_if:studySheet.health_insurance_type,1', 'nullable', 'exists:health_insurance_companies,id'],
            'studySheet.health_insurance_company' => ['required_if:studySheet.health_insurance_company_id,'.StudySheetModel::HEALTH_INSURANCE_OTHER, 'max:100'],

            'studySheet.account_holder' => [$specificCompanyPaymentValidation, 'max:50'],
            'studySheet.iban' => $ibanValidation,
            'studySheet.swift_code' => [$specificCompanyPaymentValidation, 'max:11'],

            'studySheet.is_authorize' => ['required', 'accepted'],
            'studySheet.privacy_policy' => ['required', 'accepted'],
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'studySheet.custom_billing_address.name' => __('Name/Company'),
            'studySheet.custom_billing_address.address' => __('Street and house number'),
            'studySheet.custom_billing_address.postal_code' => __('Postal code'),
            'studySheet.custom_billing_address.location' => __('Location'),
            'studySheet.custom_billing_address.address_suffix' => __('Address Suffix'),
            'studySheet.custom_billing_address.country' => __('Country'),

            'studySheet.custom_delivery_address.name' => __('Name/Company'),
            'studySheet.custom_delivery_address.address' => __('Street and house number'),
            'studySheet.custom_delivery_address.postal_code' => __('Postal code'),
            'studySheet.custom_delivery_address.location' => __('Location'),
            'studySheet.custom_delivery_address.address_suffix' => __('Address Suffix'),
            'studySheet.custom_delivery_address.country' => __('Country'),

            'studySheet.health_insurance_type' => __('Health insurance type'),
            'studySheet.health_insurance_number' => __('Health insurance number'),
            'studySheet.health_insurance_company_id' => __('Health insurance company'),
            'studySheet.health_insurance_company' => __('Health insurance company'),

            'studySheet.account_holder' => __('Account holder'),
            'studySheet.iban' => __('IBAN'),
            'studySheet.swift_code' => __('BIC – Swift-Code'),
            'studySheet.is_authorize' => __('Is authorize'),

            'studySheet.privacy_policy' => __('Privacy Policy'),
        ];
    }

    protected function messages(): array
    {
        return [
            'studySheet.health_insurance_number.regex' => __('Please note the correct format (e.g L123456789)'),
            'studySheet.iban.regex' => __('Please note the correct format (e.g DE 01 234567891234567890)'),
            'studySheet.custom_billing_address.name.required_if' => __('The name is required if your billing address is custom.'),
            'studySheet.custom_billing_address.address.required_if' => __('The address is required if your billing address is custom.'),
            'studySheet.custom_billing_address.postal_code.required_if' => __('The postal code is required if your billing address is custom.'),
            'studySheet.custom_billing_address.location.required_if' => __('The location is required if your billing address is custom.'),
            'studySheet.custom_billing_address.country.required_if' => __('The country is required if your billing address is custom.'),
            'studySheet.custom_delivery_address.name.required_if.required_if' => __('The name is required if your delivery address is custom.'),
            'studySheet.custom_delivery_address.address.required_if' => __('The address is required if your delivery address is custom.'),
            'studySheet.custom_delivery_address.postal_code.required_if' => __('The postal code is required if your delivery address is custom.'),
            'studySheet.custom_delivery_address.location.required_if' => __('The location is required if your delivery address is custom.'),
            'studySheet.custom_delivery_address.country.required_if' => __('The country is required if your delivery address is custom.'),
            'studySheet.health_insurance_number.required_if' => __('The health insurance number is required if you are insured by law.'),
            'studySheet.health_insurance_company_id.required_if' => __('The health insurance company is required if you are insured by law.'),
            'studySheet.health_insurance_company.required_if' => __('The health insurance company name is required if another health insurance company you take insurance.'),
        ];
    }
}
