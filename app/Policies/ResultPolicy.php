<?php

namespace App\Policies;

use App\Enums\ApplicationStatus;
use App\Models\Result;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResultPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        $applicantStatus = $user->application_status;
        $applicationRejectStatus = [ApplicationStatus::APPLICATION_REJECTED_BY_APPLICANT, ApplicationStatus::APPLICATION_REJECTED_BY_NAK];
        if (in_array($applicantStatus, $applicationRejectStatus)) {
            return false;
        }

        return true;
    }

    public function update(User $user, Result $result): bool
    {
        $applicantStatus = $user->application_status;

        $applicationRejectStatus = [ApplicationStatus::APPLICATION_REJECTED_BY_APPLICANT, ApplicationStatus::APPLICATION_REJECTED_BY_NAK];
        if (in_array($applicantStatus, $applicationRejectStatus)) {
            return false;
        }

        if (auth()->user()->hasRole([ROLE_ADMIN, ROLE_EMPLOYEE, ROLE_APPLICANT])) {
            if ($user->isSelectionTestingMode()) {
                return true;
            }
        }

        return false;
    }
}
