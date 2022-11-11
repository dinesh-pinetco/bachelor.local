<?php

namespace App\Services;

use App\Models\ApplicationStatus;
use App\Models\User;

class ExportStatistics
{
    public array $params = ['id'];

    public $applicant;

    public $courseId;

    public string $desiredBeginningDate;

    public array $rejectedStatus
        = [User::STATUS_APPLICATION_REJECTED_BY_NAK, User::STATUS_APPLICATION_REJECTED_BY_APPLICANT];

    private array $statusText;

    public function __construct(string $desiredBeginningDate)
    {
        $this->desiredBeginningDate = $desiredBeginningDate;

        $this->applicant = User::role(ROLE_APPLICANT)
            ->whereRelation('course', 'course_start_date', $this->desiredBeginningDate);

        $this->statusText = ApplicationStatus::get()->pluck('name', 'id')->toArray();
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

    private function checkedCompetencyCatchUp($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->where('competency_catch_up', 1)
            ->whereHas('audits', function ($query) {
                $query->where('new_values->competency_catch_up', 1);
            })
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function rejectedApplicants($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->whereIn('application_status_id', $this->rejectedStatus)
            ->whereHas('audits', function ($query) {
                $query->where('new_values->application_status_id',
                    $this->statusText[User::STATUS_APPLICATION_REJECTED_BY_APPLICANT])
                    ->orWhere('new_values->application_status_id',
                        User::STATUS_APPLICATION_REJECTED_BY_APPLICANT)
                    ->orWhere('new_values->application_status_id',
                        $this->statusText[User::STATUS_APPLICATION_REJECTED_BY_NAK])
                    ->orWhere('new_values->application_status_id',
                        User::STATUS_APPLICATION_REJECTED_BY_NAK);
            })
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function incompleteApplications($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->where('application_status_id', User::STATUS_APPLICATION_INCOMPLETE)
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function submittedApplications($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->where('application_status_id', User::STATUS_APPLICATION_SUBMITTED)
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function rejectedApplicationsBeforeSubmittedStage($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->whereIn('application_status_id', $this->rejectedStatus)
            ->whereHas('audits', function ($query) {
                $query->where(function ($query1) {
                    $query1->where('old_values->application_status_id',
                        $this->statusText[User::STATUS_APPLICATION_INCOMPLETE])
                        ->orWhere('old_values->application_status_id',
                            User::STATUS_APPLICATION_INCOMPLETE);
                })
                    ->where(function ($query1) {
                        $query1->where('new_values->application_status_id',
                            $this->statusText[User::STATUS_APPLICATION_REJECTED_BY_APPLICANT])
                            ->orWhere('new_values->application_status_id',
                                User::STATUS_APPLICATION_REJECTED_BY_APPLICANT)
                            ->orWhere('new_values->application_status_id',
                                $this->statusText[User::STATUS_APPLICATION_REJECTED_BY_NAK])
                            ->orWhere('new_values->application_status_id',
                                User::STATUS_APPLICATION_REJECTED_BY_NAK);
                    });
            })
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function approvedApplications($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->where('application_status_id', User::STATUS_APPLICATION_ACCEPTED)
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function rejectedApplicationsBeforeApprovedStage($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->whereIn('application_status_id', $this->rejectedStatus)
            ->whereHas('audits', function ($query) {
                $query->where(function ($query1) {
                    $query1->where('old_values->application_status_id',
                        $this->statusText[User::STATUS_APPLICATION_SUBMITTED])
                        ->orWhere('old_values->application_status_id',
                            User::STATUS_APPLICATION_SUBMITTED);
                })
                    ->where(function ($query1) {
                        $query1->where('new_values->application_status_id',
                            $this->statusText[User::STATUS_APPLICATION_REJECTED_BY_APPLICANT])
                            ->orWhere('new_values->application_status_id',
                                User::STATUS_APPLICATION_REJECTED_BY_APPLICANT)
                            ->orWhere('new_values->application_status_id',
                                $this->statusText[User::STATUS_APPLICATION_REJECTED_BY_NAK])
                            ->orWhere('new_values->application_status_id',
                                User::STATUS_APPLICATION_REJECTED_BY_NAK);
                    });
            })
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function testCompleted($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->where('application_status_id', User::STATUS_TEST_TAKEN)
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function rejectedApplicationsBeforeTestStage($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->whereIn('application_status_id', $this->rejectedStatus)
            ->whereHas('audits', function ($query) {
                $query->where(function ($query1) {
                    $query1->where('old_values->application_status_id',
                        $this->statusText[User::STATUS_APPLICATION_ACCEPTED])
                        ->orWhere('old_values->application_status_id',
                            User::STATUS_APPLICATION_ACCEPTED);
                })
                    ->where(function ($query1) {
                        $query1->where('new_values->application_status_id',
                            $this->statusText[User::STATUS_APPLICATION_REJECTED_BY_APPLICANT])
                            ->orWhere('new_values->application_status_id',
                                User::STATUS_APPLICATION_REJECTED_BY_APPLICANT)
                            ->orWhere('new_values->application_status_id',
                                $this->statusText[User::STATUS_APPLICATION_REJECTED_BY_NAK])
                            ->orWhere('new_values->application_status_id',
                                User::STATUS_APPLICATION_REJECTED_BY_NAK);
                    });
            })
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function completedInterviews($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->where('application_status_id', User::STATUS_SELECTION_INTERVIEW_ON)
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function rejectedApplicationsBeforeInterviewStage($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->whereIn('application_status_id', $this->rejectedStatus)
            ->whereHas('audits', function ($query) {
                $query->where(function ($query1) {
                    $query1->where('old_values->application_status_id',
                        $this->statusText[User::STATUS_TEST_TAKEN])
                        ->orWhere('old_values->application_status_id',
                            User::STATUS_TEST_TAKEN);
                })
                    ->where(function ($query1) {
                        $query1->where('new_values->application_status_id',
                            $this->statusText[User::STATUS_APPLICATION_REJECTED_BY_APPLICANT])
                            ->orWhere('new_values->application_status_id',
                                User::STATUS_APPLICATION_REJECTED_BY_APPLICANT)
                            ->orWhere('new_values->application_status_id',
                                $this->statusText[User::STATUS_APPLICATION_REJECTED_BY_NAK])
                            ->orWhere('new_values->application_status_id',
                                User::STATUS_APPLICATION_REJECTED_BY_NAK);
                    });
            })
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function contractSent($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->where('application_status_id', User::STATUS_CONTRACT_SENT_ON)
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function rejectedApplicationsBeforeContractSent($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->whereIn('application_status_id', $this->rejectedStatus)
            ->whereHas('audits', function ($query) {
                $query->where(function ($query1) {
                    $query1->where('old_values->application_status_id',
                        $this->statusText[User::STATUS_SELECTION_INTERVIEW_ON])
                        ->orWhere('old_values->application_status_id',
                            User::STATUS_SELECTION_INTERVIEW_ON);
                })
                    ->where(function ($query1) {
                        $query1->where('new_values->application_status_id',
                            $this->statusText[User::STATUS_APPLICATION_REJECTED_BY_APPLICANT])
                            ->orWhere('new_values->application_status_id',
                                User::STATUS_APPLICATION_REJECTED_BY_APPLICANT)
                            ->orWhere('new_values->application_status_id',
                                $this->statusText[User::STATUS_APPLICATION_REJECTED_BY_NAK])
                            ->orWhere('new_values->application_status_id',
                                User::STATUS_APPLICATION_REJECTED_BY_NAK);
                    });
            })
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function contractReturn($method)
    {
        //        Todo: Below Code must be change.
        $applicant = clone $this->applicant;

        return $applicant->where('application_status_id', User::STATUS_CONTRACT_RETURNED_ON)
            ->where(function ($q) {
                $q->whereDoesntHave('study_sheet')
                    ->orWhereHas('study_sheet', function ($q) {
                        $q->where('is_submit', '!=', 1);
                    })
                    ->orWhereDoesntHave('government_form')
                    ->orWhereHas('government_form', function ($q) {
                        $q->where('is_submit', '!=', 1);
                    });
            })
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function rejectedApplicationsBeforeContractReturn($method)
    {
        $applicant = clone $this->applicant;

        return $applicant->whereIn('application_status_id', $this->rejectedStatus)
            ->whereHas('audits', function ($query) {
                $query->where(function ($query1) {
                    $query1->where('old_values->application_status_id',
                        $this->statusText[User::STATUS_CONTRACT_SENT_ON])
                        ->orWhere('old_values->application_status_id',
                            User::STATUS_CONTRACT_SENT_ON);
                })
                    ->where(function ($query1) {
                        $query1->where('new_values->application_status_id',
                            $this->statusText[User::STATUS_APPLICATION_REJECTED_BY_APPLICANT])
                            ->orWhere('new_values->application_status_id',
                                User::STATUS_APPLICATION_REJECTED_BY_APPLICANT)
                            ->orWhere('new_values->application_status_id',
                                $this->statusText[User::STATUS_APPLICATION_REJECTED_BY_NAK])
                            ->orWhere('new_values->application_status_id',
                                User::STATUS_APPLICATION_REJECTED_BY_NAK);
                    });
            })
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }

    private function applicationEnroll($method)
    {
        $applicant = clone $this->applicant;

        return $applicant
            ->whereHas('study_sheet', function ($query) {
                $query->where('is_submit', 1);
            })
            ->whereHas('government_form', function ($query) {
                $query->where('is_submit', 1);
            })
            ->coursesIn([$this->courseId])
            ->{$method}($this->params);
    }
}
