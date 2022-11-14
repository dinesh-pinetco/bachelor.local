<?php

namespace App\Http\Controllers\Employee;

use App\Enums\ApplicationStatus;
use App\Http\Controllers\Controller;
use App\Models\Result;
use App\Models\Test;
use App\Models\User;
use App\Services\Meteor;
use App\Services\Moodle;

class SelectionTestController extends Controller
{
    public function index(User $applicant)
    {
        return view('employee.applicants.selection-tests.index', compact('applicant'));
    }

    public function show(User $applicant, Test $selection_test)
    {
        if (! in_array($applicant->application_status, [ApplicationStatus::APPLICATION_REJECTED_BY_APPLICANT, ApplicationStatus::APPLICATION_REJECTED_BY_NAK])) {
            $result = $selection_test->results()
                ->myResults($applicant)
                ->where('status', Result::STATUS_STARTED)
                ->where('is_passed', 0)
                ->first();

            if ($result && ! $result->is_passed && $result->static != Result::STATUS_COMPLETED) {
                if ($selection_test->type == Test::TYPE_MOODLE) {
                    (new Moodle($applicant))->fetchResult($result);
                } elseif ($selection_test->type == Test::TYPE_METEOR) {
                    (new Meteor($applicant))->fetchResult($result);
                }
            }
        }

        return view('employee.applicants.selection-tests.show', ['applicant' => $applicant, 'test' => $selection_test]);
    }
}
