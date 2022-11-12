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
        $applicantStatus = $applicant?->application_status;

        $nakUniversityId = University::where('name', 'NORDAKADEMIE')->first()->id;

        $universityId = $applicant->getValueByField('university');
        $universityId = $universityId != null ? $universityId->value : null;

        $grade = $applicant->getValueByField('grade');
        $grade = $grade != null ? str_replace(',', '.', $grade->value) : null;

        $this->message = '';
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
