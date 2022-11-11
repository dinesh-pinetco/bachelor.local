<?php

namespace App\Policies;

use App\Models\Result;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResultPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        $applicantStatus = $user->application_status_id;
        $applicationRejectStatus = [User::STATUS_APPLICATION_REJECTED_BY_APPLICANT, User::STATUS_APPLICATION_REJECTED_BY_NAK];
        if (in_array($applicantStatus, $applicationRejectStatus)) {
            return false;
        }

        return true;
    }

    public function update(User $user, Result $result): bool
    {
        $applicantStatus = $user->application_status_id;
        $applicationRejectStatus = [User::STATUS_APPLICATION_REJECTED_BY_APPLICANT, User::STATUS_APPLICATION_REJECTED_BY_NAK];
        if (in_array($applicantStatus, $applicationRejectStatus)) {
            return false;
        }

        if (auth()->user()->hasRole([ROLE_ADMIN, ROLE_EMPLOYEE, ROLE_APPLICANT])) {
            $applicationRejectStatus = [User::STATUS_APPLICATION_ACCEPTED];
            if (in_array($applicantStatus, $applicationRejectStatus)) {
                return true;
            }
        }

        return false;
    }
}
