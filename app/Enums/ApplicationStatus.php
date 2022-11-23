<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Meta\Meta;
use ArchTech\Enums\Metadata;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

#[Meta(ApplicationStatusOrder::class)]
enum ApplicationStatus: string
{
    use InvokableCases, Names, Values, Options, Metadata;

    #[ApplicationStatusOrder(1)] case REGISTRATION_SUBMITTED = 'registration_submitted';
    #[ApplicationStatusOrder(2)] case PROFILE_INFORMATION_COMPLETED = 'profile_information_completed';

    #[ApplicationStatusOrder(3)] case TEST_TAKEN = 'test_taken';
    #[ApplicationStatusOrder(5)] case TEST_FAILED = 'test_failed';
    #[ApplicationStatusOrder(4)] case TEST_PASSED = 'test_passed';
    #[ApplicationStatusOrder(6)] case TEST_FAILED_CONFIRM = 'test_failed_confirm';
    #[ApplicationStatusOrder(7)] case TEST_RESET = 'test_reset';
    #[ApplicationStatusOrder(8)] case TEST_RESULT_PDF_RETRIEVED_ON = 'test_result_pdf_retrieved_on';

    #[ApplicationStatusOrder(9)] case PERSONAL_DATA_COMPLETED = 'personal_data_completed';
    #[ApplicationStatusOrder(10)] case CONSENT_TO_COMPANY_PORTAL_BULLETIN_BOARD = 'consent_to_company_portal_bulletin_board';
    #[ApplicationStatusOrder(11)] case APPROVED_BY_COMPANY_FOR_ENROLMENT = 'approved_by_company_for_enrolment';
    #[ApplicationStatusOrder(12)] case APPLICATION_REJECTED_BY_APPLICANT = 'application_rejected_by_applicant';
    #[ApplicationStatusOrder(13)] case APPLICATION_REJECTED_BY_NAK = 'application_rejected_by_nak';

    /** Get an associative array of [case name => case value]. */
    public static function selectionOptions(): array
    {
        $cases = static::cases();

        $options = collect();
        foreach (array_column($cases, 'value', 'name') as $key => $option) {
            $options->push(['id' => $key, 'label' => __($option)]);
        }

        return $options->toArray();
    }

    public function id()
    {
        return $this->applicationStatusOrder();
    }
}
