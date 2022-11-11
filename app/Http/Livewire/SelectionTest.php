<?php

namespace App\Http\Livewire;

use App\Models\Result;
use App\Models\University;
use App\Models\User;
use Livewire\Component;

class SelectionTest extends Component
{
    public $tests;

    public $message;

    public function mount()
    {
        $this->message = '';
        $applicant = auth()->user()->hasRole(ROLE_APPLICANT) ? auth()->user() : null;
        $applicantStatus = $applicant?->application_status_id;

        $nakUniversityId = University::where('name', 'NORDAKADEMIE')->first()->id;

        $universityId = $applicant->getValueByField('university');
        $universityId = $universityId != null ? $universityId->value : null;

        $grade = $applicant->getValueByField('grade');
        $grade = $grade != null ? str_replace(',', '.', $grade->value) : null;

        if ($applicantStatus == User::STATUS_APPLICATION_ACCEPTED) {
            $this->message = '';
        } elseif (in_array($applicantStatus, [User::STATUS_APPLICATION_REJECTED_BY_NAK, User::STATUS_APPLICATION_REJECTED_BY_APPLICANT])) {
            $this->message = __('Dear applicant, Your application is rejected. If any other queries please contact the support team.');
        } elseif (in_array($applicantStatus, [User::STATUS_APPLICATION_INCOMPLETE, User::STATUS_APPLICATION_SUBMITTED])) {
            $this->message = __('Dear applicant, Please fill in all the required fields and submit your application, after which you will be notified by email when you are cleared for the selection tests');
        } elseif (in_array($applicantStatus, [User::STATUS_TEST_TAKEN, User::STATUS_SELECTION_INTERVIEW_ON, User::STATUS_CONTRACT_SENT_ON, User::STATUS_CONTRACT_RETURNED_ON])) {
            if ($nakUniversityId == $universityId && $grade <= 2.5) {
                $this->message = __('Dear applicant, As you are NORDAKADEMIE Student and your grade is good. So you are directly promoted to the interview session.');
            } else {
                $this->message = __('Dear applicant, thank you for taking all 3 tests. As soon as the results are available, we will notify you and contact you with a proposed date for an interview with the head of our study program.');
            }
        }
    }

    public function render()
    {
        return view('livewire.selection-test');
    }

    public function startTest($testId)
    {
        Result::updateOrCreate(
            ['user_id' => auth()->id(), 'test_id' => $testId],
            ['status' => Result::STATUS_STARTED]
        );
    }

    public function isCompleted($test)
    {
        return $test->results()->myResults(auth()->user())->where('status', Result::STATUS_COMPLETED)->exists();
    }
}
