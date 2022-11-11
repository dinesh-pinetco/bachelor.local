<?php

namespace App\Policies;

use App\Models\FieldValue;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class FieldValuePolicy
{
    use HandlesAuthorization;

    public function create(User $user): Response|bool
    {
        $applicantStatus = $user->application_status;
        $applicationRejectStatus = [User::STATUS_APPLICATION_REJECTED_BY_APPLICANT, User::STATUS_APPLICATION_REJECTED_BY_NAK];
        if (in_array($applicantStatus, $applicationRejectStatus)) {
            return false;
        }

        return true;
    }

    public function update(User $user, FieldValue $fieldValue): Response|bool
    {
        $applicantStatus = $user->application_status;
        $applicationRejectStatus = [User::STATUS_APPLICATION_REJECTED_BY_APPLICANT, User::STATUS_APPLICATION_REJECTED_BY_NAK];
        if (in_array($applicantStatus, $applicationRejectStatus)) {
            return false;
        }
        if (auth()->user()->hasRole(ROLE_APPLICANT)) {
            $defaultDisableField = ['email', 'course_id', 'desired_beginning_id'];

            if (in_array($fieldValue->fields->key, $defaultDisableField)) {
                return false;
            } else {
                return $applicantStatus == User::STATUS_APPLICATION_INCOMPLETE;
            }
        } elseif (auth()->user()->hasRole([ROLE_ADMIN, ROLE_EMPLOYEE])) {
            $defaultDisableField = ['email'];
            if ($applicantStatus >= User::STATUS_APPLICATION_ACCEPTED) {
                $defaultDisableField = array_merge($defaultDisableField, ['course_id', 'desired_beginning_id', 'university', 'grade']);
            }

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
