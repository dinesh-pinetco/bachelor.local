<?php

namespace App\Policies;

use App\Models\Interview;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class InterviewPolicy
{
    use HandlesAuthorization;

    public function create(User $user): Response|bool
    {
        $applicantStatus = $user->application_status;
        $applicationRejectStatus = [User::STATUS_APPLICATION_REJECTED_BY_APPLICANT, User::STATUS_APPLICATION_REJECTED_BY_NAK];
        if (in_array($applicantStatus, $applicationRejectStatus)) {
            return false;
        }

        $applicationRejectStatus = [User::STATUS_TEST_TAKEN];
        if (auth()->user()->hasRole([ROLE_ADMIN, ROLE_EMPLOYEE]) && in_array($applicantStatus, $applicationRejectStatus)) {
            return true;
        } else {
            return false;
        }
    }

    public function update(User $user, Interview $interview): Response|bool
    {
        $applicantStatus = $user->application_status;
        $applicationRejectStatus = [User::STATUS_APPLICATION_REJECTED_BY_APPLICANT, User::STATUS_APPLICATION_REJECTED_BY_NAK];
        if (in_array($applicantStatus, $applicationRejectStatus)) {
            return false;
        }

        $applicationStatus = [User::STATUS_TEST_TAKEN, User::STATUS_SELECTION_INTERVIEW_ON, User::STATUS_CONTRACT_SENT_ON, User::STATUS_CONTRACT_RETURNED_ON];
        if (auth()->user()->hasRole([ROLE_ADMIN, ROLE_EMPLOYEE]) && in_array($applicantStatus, $applicationStatus)) {
            return true;
        } else {
            return false;
        }
    }
}
