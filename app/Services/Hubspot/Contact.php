<?php

namespace App\Services\Hubspot;

use App\Enums\ApplicationStatus;
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
            BACHELOR_APPLICANT_ID => $this->user->id,
            'email' => $this->user->email,
            'firstname' => $this->user->first_name,
            'lastname' => $this->user->last_name,
            'phone' => $this->user->phone,
            BACHELOR_DESIRED_BEGINNING => $this->desired_beginning(),
            BACHELOR_STUDY_COURSES => $this->study_courses(),
            BACHELOR_REGISTRATION_SUBMITTED => $this->updatedStatusDataTime('registration_submitted'),
            BACHELOR_PROFILE_INFORMATION_COMPLETED => $this->updatedStatusDataTime('profile_information_completed'),
            BACHELOR_TEST_TAKEN => $this->getBooleanValueOfStatus('test_taken'),
            BACHELOR_TEST_PASSED => $this->getBooleanValueOfStatus('test_passed'),
            BACHELOR_PERSONAL_DATA_COMPLETED => $this->getBooleanValueOfStatus('personal_data_completed'),
            BACHELOR_CONSENT_TO_COMPANY_PORTAL_BULLETIN_BOARD => $this->consentToCompanyPortalBulletinBoard(),
            BACHELOR_APPROVED_BY_COMPANY_FOR_ENROLMENT => $this->getBooleanValueOfStatus('enrollment_on'),
            BACHELOR_REJECTED_BY_APPLICANT => $this->getBooleanValueOfStatus('rejected_by_applicant'),
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

    private function consentToCompanyPortalBulletinBoard()
    {
        return $this->user->audits
            ->whereIn('new_values.application_status', [
                ApplicationStatus::APPLYING_TO_SELECTED_COMPANY(),
                ApplicationStatus::APPLIED_TO_SELECTED_COMPANY(),
            ])
            ->isNotEmpty();
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
