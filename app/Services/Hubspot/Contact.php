<?php

namespace App\Services\Hubspot;

use App\Models\ApplicationStatus;
use App\Models\University;
use App\Models\User;
use App\Traits\Makeable;

class Contact
{
    use Makeable;

    public function __construct(protected User $user)
    {
        $this->user->load(['courseModel' => function ($q) {
            $q->with('course', 'desired_beginning');
        }, 'values.fields', 'audits']);
    }

    public static function getUserInformationKeys()
    {
        return [
            'email',
            'first_name',
            'last_name',
            'phone',
            'course_id',
            'desired_beginning',
            'university',
            'Studiengang eingeben',
        ];
    }

    public function get()
    {
        return [
            'email'                               => $this->user->email,
            'firstname'                           => $this->user->first_name,
            'lastname'                            => $this->user->last_name,
            'phone'                               => $this->user->phone,
            'study_course'                        => $this->study_course(),
            'desired_beginning'                   => $this->desired_beginning(),
            'previous_university'                 => $this->previous_university(),
            'study_course_of_previous_university' => $this->study_course_of_previous_university(),
            'application_submitted'               => $this->application_submitted(),
            'application_accepted'                => $this->application_accepted(),
            'test_completed'                      => $this->test_completed(),
            'selection_interview_on'              => $this->selection_interview_on(),
            'contract_sent_on'                    => $this->contract_sent_on(),
            'contract_returned_on'                => $this->contract_returned_on(),
            'rejected_by_applicant'               => $this->rejected_by_applicant(),
            'rejected_by_nak'                     => $this->rejected_by_nak(),
        ];
    }

    public function application_submitted()
    {
        return $this->getBooleanValueOfStatus('application_submitted');
    }

    public function application_accepted()
    {
        return $this->getBooleanValueOfStatus('application_accepted');
    }

    public function test_completed()
    {
        return $this->getBooleanValueOfStatus('test_completed');
    }

    public function rejected_by_applicant()
    {
        return $this->getBooleanValueOfStatus('rejected_by_applicant');
    }

    public function rejected_by_nak()
    {
        return $this->getBooleanValueOfStatus('rejected_by_nak');
    }

    private function study_course()
    {
        return data_get($this->user->courseModel, 'course.name');
    }

    private function desired_beginning()
    {
        return collect([data_get($this->user->courseModel, 'desired_beginning.name'), $this->user->courseModel?->course_start_date?->format('Y')])->filter()->implode(' ');
    }

    private function previous_university()
    {
        return University::where('id', collect($this->user->values)->where('fields.key', 'university')->first()?->value)
            ->value('name');
    }

    private function study_course_of_previous_university()
    {
        return collect($this->user->values)
            ->where('fields.label', 'Studiengang eingeben')
            ->first()?->value;
    }

    public function selection_interview_on()
    {
        $date = $this->user->audits
            ->where('new_values.application_status_id',
                ApplicationStatus::where('identifier', 'selection_interview_on')->value('name'))
            ->last()?->created_at;

        if ($date) {
            return datetimeFormatForHubspot($date);
        }
    }

    public function contract_sent_on()
    {
        $date = $this->user->audits
            ->where('new_values.application_status_id',
                ApplicationStatus::where('identifier', 'contract_sent_on')->value('name'))
            ->last()?->created_at;

        if ($date) {
            return datetimeFormatForHubspot($date);
        }
    }

    public function contract_returned_on()
    {
        $date = $this->user->audits
            ->where('new_values.application_status_id',
                ApplicationStatus::where('identifier', 'contract_returned_on')->value('name'))
            ->last()?->created_at;

        if ($date) {
            return datetimeFormatForHubspot($date);
        }
    }

    private function getBooleanValueOfStatus($status)
    {
        return $this->user->audits
            ->where('new_values.application_status_id',
                ApplicationStatus::where('identifier', $status)->value('name'))
            ->isNotEmpty();
    }
}
