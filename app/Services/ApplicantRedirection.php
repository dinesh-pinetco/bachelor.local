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
        return redirect()->route('application.index', ['tab' => 'profile']);
    }

    private function application_rejected_by_applicant()
    {
        return redirect()->route('application.index', ['tab' => 'profile']);
    }

    private function profile_information_completed()
    {
        return redirect()->route('selection-test.index');
    }

    private function test_taken()
    {
        return redirect()->route('selection-test.index');
    }

    private function test_passed()
    {
        return redirect()->route('selection-test.index');
    }

    private function test_failed_confirm()
    {
        return redirect()->route('selection-test.index');
    }

    private function test_result_pdf_retrieved_on()
    {
        return redirect()->route('application.index', ['tab' => 'industries']);
    }
}
