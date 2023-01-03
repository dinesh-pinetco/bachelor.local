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

        if ($filteredBy == 'interested') {
            return $this->interested($method);
        } elseif ($filteredBy == ApplicationStatus::TEST_FAILED()) {
            return $this->test_failed($method);
        }

        return $this->userFilter(null)
            ->{$method}($this->params);
    }

    public function interested($method)
    {
        return $this->userFilter(ApplicationStatus::PROFILE_INFORMATION_COMPLETED)
            ->{$method}($this->params);
    }

    public function test_failed($method)
    {
        return $this->userFilter(ApplicationStatus::TEST_FAILED)
            ->{$method}($this->params);
    }

    private function userFilter($status)
    {
        return User::role(ROLE_APPLICANT)
            ->filter()
            ->where('application_status', $status);
    }
}
