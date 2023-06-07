<?php

namespace App\Services;

use App\Models\User;
use App\Traits\Makeable;

class ApplicantRedirection
{
    use Makeable;

    public function __construct(private User $applicant)
    {
    }

    public function route()
    {
        $applicationStatus = $this->applicant->application_status;

        return $this->{$applicationStatus->value}();
    }

    private function registration_submitted()
    {
        return to_route('application.index', ['tab' => 'profile']);
    }

    private function application_rejected_by_applicant()
    {
        return to_route('application.index', ['tab' => 'profile']);
    }

    private function profile_information_completed()
    {
        return to_route('selection-test.index');
    }

    private function test_taken()
    {
        return to_route('selection-test.index');
    }

    private function test_passed()
    {
        return to_route('selection-test.index');
    }

    private function test_reset()
    {
        return to_route('selection-test.index');
    }

    private function test_failed()
    {
        return to_route('selection-test.index');
    }

    private function test_failed_confirm()
    {
        return to_route('selection-test.index');
    }

    private function test_result_pdf_retrieved_on()
    {
        return to_route('companies.index');
    }

    private function personal_data_completed()
    {
        return to_route('companies.index');
    }

    private function consent_to_company_portal_bulletin_board()
    {
        return to_route('companies.index');
    }

    private function applying_to_selected_company()
    {
        return to_route('companies.index');
    }

    private function applied_to_selected_company()
    {
        return to_route('companies.index');
    }

    private function show_application_on_marketplace()
    {
        return to_route('companies.index');
    }

    private function enrollment_on()
    {
        return to_route('companies.index');
    }

    private function contract_sent_on()
    {
        return to_route('companies.index');
    }

    private function contract_returned_on()
    {
        return to_route('companies.index');
    }

    private function applied_on_marketplace()
    {
        return to_route('companies.index');
    }
}
