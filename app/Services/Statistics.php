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

        if ($filteredBy == 'applicationIncomplete') {
            return $this->applicationIncomplete($method);
        } elseif ($filteredBy == 'submitted') {
            return $this->submitted($method);
        } elseif ($filteredBy == 'competencyCatchUp') {
            return $this->competencyCatchUp($method);
        } elseif ($filteredBy == 'testCompleted') {
            return $this->testPassed($method);
        } elseif ($filteredBy == 'contractCompleted') {
            return $this->contracts($method);
        } elseif ($filteredBy == ApplicationStatus::TEST_FAILED()) {
            return $this->test_failed($method);
        }

        return $this->applicantFilterByApplication(null)
            ->{$method}($this->params);
    }

    public function applicationIncomplete($method)
    {
        return $this->applicantFilterByApplication(ApplicationStatus::PROFILE_INFORMATION_COMPLETED())
            ->{$method}($this->params);
    }

    public function test_failed($method)
    {
        return $this->applicantFilterByApplication(ApplicationStatus::TEST_FAILED())
            ->{$method}($this->params);
    }

    private function applicantFilterByApplication(...$statuses)
    {
        return User::query()
            ->role(ROLE_APPLICANT)
            ->filter()
            ->whereIn('application_status', $statuses);
    }

    public function submitted($method)
    {
        return $this->applicantFilterByApplication(ApplicationStatus::PERSONAL_DATA_COMPLETED())
            ->{$method}($this->params);
    }

    public function competencyCatchUp($method)
    {
        return User::role(ROLE_APPLICANT)
            ->whereHas('configuration', function ($q) {
                $q->where('competency_catch_up', true);
            })
            ->{$method}($this->params);
    }

    public function testPassed($method)
    {
        return $this->applicantFilterByApplication(ApplicationStatus::TEST_PASSED())
            ->{$method}($this->params);
    }

    public function contracts($method)
    {
        return $this->applicantFilterByApplication(ApplicationStatus::CONTRACT_RETURNED_ON(), ApplicationStatus::CONTRACT_SENT_ON())
            ->{$method}($this->params);
    }
}
