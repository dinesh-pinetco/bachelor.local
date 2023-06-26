<?php

namespace App\Services;

use App\Enums\ApplicationStatus;
use App\Models\User;

class ExportStatistics
{
    public array $params = ['id'];

    public $applicant;

    public $courseId;

    public string $desiredBeginningDate;

    public array $rejectedStatus
        = [ApplicationStatus::APPLICATION_REJECTED_BY_NAK, ApplicationStatus::APPLICATION_REJECTED_BY_APPLICANT];

    public function __construct(string $desiredBeginningDate)
    {
        $this->desiredBeginningDate = $desiredBeginningDate;

        $this->applicant = User::role(ROLE_APPLICANT)
            ->whereRelation('desiredBeginning', 'course_start_date', $this->desiredBeginningDate);
    }

    public function getApplicantsByFilter($filteredBy, $method, $courseId)
    {
        $this->courseId = $courseId;

        if (method_exists($this, $filteredBy)) {
            return $this->{$filteredBy}($method);
        }
    }

    private function totalApplicants($method)
    {
        $applicant = clone $this->applicant;

        return $applicant
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function rejectedApplicants($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->whereIn('application_status', $this->rejectedStatus)
            ->whereHas('audits', function ($query) {
                $query->where('new_values->application_status', ApplicationStatus::APPLICATION_REJECTED_BY_APPLICANT)
                    ->orWhere('new_values->application_status',
                        ApplicationStatus::APPLICATION_REJECTED_BY_NAK);
            })
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function registrationSubmitted($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->where('application_status', ApplicationStatus::REGISTRATION_SUBMITTED)
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function profileInformationCompleted($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->where('application_status', ApplicationStatus::PROFILE_INFORMATION_COMPLETED)
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function testCompleted($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->where('application_status', ApplicationStatus::TEST_TAKEN)
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function testPassed($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->where('application_status', ApplicationStatus::TEST_PASSED)
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function testFailed($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->whereIn('application_status', [ApplicationStatus::TEST_FAILED, ApplicationStatus::TEST_RESET])
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function testFailedConfirm($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->where('application_status', ApplicationStatus::TEST_FAILED_CONFIRM)
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function testResultPdfRetrievedOn($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->where('application_status', ApplicationStatus::TEST_RESULT_PDF_RETRIEVED_ON)
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function personalDataCompleted($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->where('application_status', ApplicationStatus::APPLIED_ON_MARKETPLACE)
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function consentToCompanyPortalBulletinBoard($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->hasConsentToCompanyPortalBulletinBoard()
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function approvedByCompanyForEnrollment($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->whereIn('application_status', [
            ApplicationStatus::ENROLLMENT_ON,
            ApplicationStatus::CONTRACT_SENT_ON,
            ApplicationStatus::CONTRACT_RETURNED_ON, ])
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }
}
