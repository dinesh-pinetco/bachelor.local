<?php

namespace App\Http\Livewire;

use App\Enums\ApplicationStatus;
use App\Models\Result;
use App\Models\Test;
use App\Models\User;
use App\Services\ApplicantRedirection;
use App\Traits\Livewire\HasModal;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class SelectionTest extends Component
{
    use HasModal;

    public User $applicant;

    public function mount()
    {
        $this->applicant = auth()->user();
    }

    public function render()
    {
        return view('livewire.selection-test', [
            'tests' => Test::query()
                ->matchCourses($this->applicant->courses->pluck('course_id')->toArray())
                ->with(['result' => function ($q) {
                    $q->where('user_id', $this->applicant->id);
                }])
                ->get(),
        ]);
    }

    public function startTest($testId)
    {
        Result::updateOrCreate(
            ['user_id' => $this->applicant->id, 'test_id' => $testId],
            ['status' => Result::STATUS_STARTED]
        );
    }

    public function getTestResultPdf()
    {
        if ($this->applicant->application_status == ApplicationStatus::TEST_PASSED) {
            $this->open();
            $file = $this->applicant->configuration()->get()->first()->selection_test_result_passed_pdf_path;
            return response()->download(public_path('/storage/' . $file));
        }

        //TODO:pooja Generated pdf of result
        $file = $this->applicant->configuration()->get()->first()->selection_test_result_failed_pdf_path;
        return response()->download(public_path('/storage/' . $file));
    }

    public function testResultRetrievedOn()
    {
        $this->applicant->application_status = ApplicationStatus::TEST_RESULT_PDF_RETRIEVED_ON;
        $this->applicant->save();

        return ApplicantRedirection::make($this->applicant)->route();
    }
}
