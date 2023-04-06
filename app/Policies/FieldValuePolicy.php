<?php

namespace App\Policies;

use App\Enums\ApplicationStatus;
use App\Models\FieldValue;
use App\Models\User;
use App\Services\ProgressBar;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FieldValuePolicy
{
    use HandlesAuthorization;

    public function create(User $user): Response|bool
    {
        $applicantStatus = $user->application_status;
        $applicationRejectStatus = [ApplicationStatus::APPLICATION_REJECTED_BY_APPLICANT, ApplicationStatus::APPLICATION_REJECTED_BY_NAK];
        if (in_array($applicantStatus, $applicationRejectStatus)) {
            return false;
        }

        return true;
    }

    public function update(User $user, FieldValue $fieldValue): Response|bool
    {
        $defaultDisableField = ['email', 'course_id', 'desired_beginning_id'];
        $applicantStatus = $user->application_status;
        $applicationRejectStatus = [ApplicationStatus::APPLICATION_REJECTED_BY_APPLICANT, ApplicationStatus::APPLICATION_REJECTED_BY_NAK];
        if (in_array($applicantStatus, $applicationRejectStatus)) {
            return false;
        }
        if (auth()->user()->hasRole(ROLE_APPLICANT)) {
            if (in_array($fieldValue->fields->key, $defaultDisableField)) {
                return false;
            } else {
                return ! $fieldValue->is_process_countable_field || (new ProgressBar(auth()->id()))->overAllProgress() != 100;
            }
        } elseif (auth()->user()->hasRole([ROLE_ADMIN, ROLE_EMPLOYEE])) {
            if (in_array($fieldValue->fields->key, $defaultDisableField)) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
}
