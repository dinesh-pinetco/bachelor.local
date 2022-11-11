<?php

namespace App\Policies;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ContractPolicy
{
    use HandlesAuthorization;

    public function create(User $user): Response|bool
    {
        $applicantStatus = $user->application_status_id;
        $applicationRejectStatus = [User::STATUS_APPLICATION_REJECTED_BY_APPLICANT, User::STATUS_APPLICATION_REJECTED_BY_NAK];
        if (in_array($applicantStatus, $applicationRejectStatus)) {
            return false;
        }

        return true;
    }

    public function update(User $user, Contract $contract): Response|bool
    {
        $applicantStatus = $user->application_status_id;
        $applicationRejectStatus = [User::STATUS_APPLICATION_REJECTED_BY_APPLICANT, User::STATUS_APPLICATION_REJECTED_BY_NAK];
        if (in_array($applicantStatus, $applicationRejectStatus)) {
            return false;
        }

        return true;
    }
}
