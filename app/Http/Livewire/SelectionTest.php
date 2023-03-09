<?php

namespace App\Http\Livewire;

use App\Enums\ApplicationStatus;
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

    public function getTestResultPdf()
    {
        if ($this->applicant->application_status == ApplicationStatus::TEST_PASSED) {
            $this->open();

            return Storage::download($this->applicant->configuration->selection_test_result_passed_pdf_path);
        }

        return Storage::download($this->applicant->configuration->selection_test_result_failed_pdf_path);
    }

    public function testResultRetrievedOn()
    {
        $this->applicant->application_status = ApplicationStatus::TEST_RESULT_PDF_RETRIEVED_ON;
        $this->applicant->save();

        return ApplicantRedirection::make($this->applicant)->route();
    }
}
