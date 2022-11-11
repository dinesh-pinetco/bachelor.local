<?php

namespace App\Services;

use App\Models\User;

class Statistics
{
    public int|string $params = 'id';

    public function getApplicantsByFilter($filteredBy, $method, $params)
    {
        $this->params = $params;

        if ($filteredBy == 'interested') {
            return $this->interested($method);
        } elseif ($filteredBy == 'approved') {
            return $this->approved($method);
        } elseif ($filteredBy == 'submitted') {
            return $this->submitted($method);
        } elseif ($filteredBy == 'competencyCatchUp') {
            return $this->competencyCatchUp($method);
        } elseif ($filteredBy == 'testCompleted') {
            return $this->interviews($method);
        } elseif ($filteredBy == 'contractCompleted') {
            return $this->contracts($method);
        }
    }

    public function interested($method)
    {
        return $this->userFilter(User::STATUS_APPLICATION_INCOMPLETE)
            ->{$method}($this->params);
    }

    private function userFilter($status)
    {
        return User::role(ROLE_APPLICANT)
            ->filter()
            ->where('application_status_id', $status);
    }

    public function approved($method)
    {
        return $this->userFilter(User::STATUS_APPLICATION_ACCEPTED)
            ->{$method}($this->params);
    }

    public function submitted($method)
    {
        return $this->userFilter(User::STATUS_APPLICATION_SUBMITTED)
            ->{$method}($this->params);
    }

    public function competencyCatchUp($method)
    {
        return User::role(ROLE_APPLICANT)
            ->where('competency_catch_up', true)
            ->{$method}($this->params);
    }

    public function interviews($method)
    {
        return $this->userFilter(User::STATUS_TEST_TAKEN)
            ->{$method}($this->params);
    }

    public function contracts($method)
    {
        return $this->userFilter(User::STATUS_CONTRACT_RETURNED_ON)
            ->{$method}($this->params);
    }
}
