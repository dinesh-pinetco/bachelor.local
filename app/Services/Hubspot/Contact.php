<?php

namespace App\Services\Hubspot;

use App\Models\DesiredBeginning;
use App\Models\User;
use App\Traits\Makeable;

class Contact
{
    use Makeable;

    public function __construct(protected User $user)
    {
        $this->user->load(['desiredBeginning' => function ($q) {
            $q->with('courses');
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
            'Studiengang eingeben',
        ];
    }

    public function get()
    {
        return [
            'email' => $this->user->email,
            'firstname' => $this->user->first_name,
            'lastname' => $this->user->last_name,
            'phone' => $this->user->phone,
            'desired_beginning' => $this->desired_beginning(),
            'master_study_course' => $this->study_courses(),
            'registration_submitted' => $this->updatedStatusDataTime('registration_submitted'),
            'profile_information_completed' => $this->updatedStatusDataTime('profile_information_completed'),
            'test_taken' => $this->getBooleanValueOfStatus('test_taken'),
            'test_passed' => $this->getBooleanValueOfStatus('test_passed'),
            'personal_data_completed' => $this->getBooleanValueOfStatus('personal_data_completed'),
            'consent_to_company_portal_bulletin_board' => $this->getBooleanValueOfStatus('consent_to_company_portal_bulletin_board'),
            'approved_by_company_for_enrolment' => $this->getBooleanValueOfStatus('approved_by_company_for_enrolment'),
            'rejected_by_applicant' => $this->getBooleanValueOfStatus('rejected_by_applicant'),
            'rejected_by_nak' => $this->getBooleanValueOfStatus('rejected_by_nak'),
        ];
    }

    private function study_courses()
    {
        return $this->user->desiredBeginning->courses->pluck('id')->implode(';');
    }

    private function desired_beginning()
    {
        return $this->user->desiredBeginning->course_start_date->format(DesiredBeginning::TITLE);
    }

    private function getBooleanValueOfStatus($status)
    {
        return $this->user->audits
            ->where('new_values.application_status', $status)
            ->isNotEmpty();
    }

    private function updatedStatusDataTime($status)
    {
        $date = $this->user->audits
            ->where('new_values.application_status', $status)
            ->last()?->created_at;

        if ($date) {
            return datetimeFormatForHubspot($date);
        }
    }
}
