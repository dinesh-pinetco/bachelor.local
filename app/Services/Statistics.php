<?php

namespace App\Services;

use App\Enums\ApplicationStatus;
use App\Models\User;

class Statistics
{
    public int|string $params = 'id';

    public function getApplicantsByFilter($filteredBy, $method, $params)
    {
        $this->params = $params;

        if ($filteredBy == 'registerSubmit') {
            return $this->registerSubmit($method);
        } elseif ($filteredBy == 'personalInformationCompleted') {
            return $this->personalInformationCompleted($method);
        } elseif ($filteredBy == 'testTaken') {
            return $this->testTaken($method);
        } elseif ($filteredBy == 'testPassed') {
            return $this->testPassed($method);
        } elseif ($filteredBy == 'testPassed') {
            return $this->testPassed($method);
        } elseif ($filteredBy == 'testFailed') {
            return $this->testFailed($method);
        } elseif ($filteredBy == 'testFailedConfirmed') {
            return $this->testFailedConfirmed($method);
        } elseif ($filteredBy == 'testResultPdfRetrieved') {
            return $this->testResultPdfRetrieved($method);
        } elseif ($filteredBy == 'consentCompanyPortal') {
            return $this->consentCompanyPortal($method);
        } elseif ($filteredBy == 'competencyCatchUp') {
            return $this->competencyCatchUp($method);
        } elseif ($filteredBy == 'enrollment') {
            return $this->enrollment($method);
        }

        return $this->applicantFilterByApplication(null)
            ->{$method}($this->params);
    }

    public function registerSubmit($method)
    {
        return $this->applicantFilterByApplication(ApplicationStatus::REGISTRATION_SUBMITTED())
            ->{$method}($this->params);
    }

    public function personalInformationCompleted($method)
    {
        return $this->applicantFilterByApplication(ApplicationStatus::PROFILE_INFORMATION_COMPLETED())
            ->{$method}($this->params);
    }

    public function testTaken($method)
    {
        return $this->applicantFilterByApplication(ApplicationStatus::TEST_TAKEN())
            ->{$method}($this->params);
    }

    public function testPassed($method)
    {
        return $this->applicantFilterByApplication(ApplicationStatus::TEST_PASSED())
            ->{$method}($this->params);
    }

    public function testFailed($method)
    {
        return $this->applicantFilterByApplication(ApplicationStatus::TEST_FAILED())
            ->{$method}($this->params);
    }

    public function testFailedConfirmed($method)
    {
        return $this->applicantFilterByApplication(ApplicationStatus::TEST_FAILED_CONFIRM())
            ->{$method}($this->params);
    }

    public function testResultPdfRetrieved($method)
    {
        return $this->applicantFilterByApplication(ApplicationStatus::TEST_RESULT_PDF_RETRIEVED_ON())
            ->{$method}($this->params);
    }

    public function consentCompanyPortal($method)
    {
        return $this->applicantFilterByApplication(ApplicationStatus::PERSONAL_DATA_COMPLETED())
            ->{$method}($this->params);
    }

    public function enrollment($method)
    {
        return $this->applicantFilterByApplication(ApplicationStatus::ENROLLMENT_ON())
            ->{$method}($this->params);
    }

    private function applicantFilterByApplication(...$statuses)
    {
        return User::query()
            ->role(ROLE_APPLICANT)
            ->filter()
            ->whereIn('application_status', $statuses);
    }

    public function competencyCatchUp($method)
    {
        return User::role(ROLE_APPLICANT)
            ->whereHas('configuration', function ($q) {
                $q->where('competency_catch_up', true);
            })
            ->{$method}($this->params);
    }
}
