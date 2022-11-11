<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum ApplicationStatus: string
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;

    case REGISTRATION_SUBMITTED = 'registration_submitted';
    case PROFILE_INFORMATION_COMPLETED = 'profile_information_completed';
    case TEST_TAKEN = 'test_taken';
    case TEST_PASSED = 'test_passed';
    case TEST_RESULT_PDF_RETRIEVED_ON = 'test_result_pdf_retrieved_on';
    case PERSONAL_DATA_COMPLETED = 'personal_data_completed';
    case TEST_FAILED = 'test_failed';
    case TEST_FAILED_CONFIRM = 'test_failed_confirm';
    case CONSENT_TO_COMPANY_PORTAL_BULLETIN_BOARD = 'consent_to_company_portal_bulletin_board';
    case APPROVED_BY_COMPANY_FOR_ENROLMENT = 'approved_by_company_for_enrolment';
    case APPLICATION_REJECTED_BY_APPLICANT = 'application_rejected_by_applicant';
    case APPLICATION_REJECTED_BY_NAK = 'application_rejected_by_nak';

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
}
