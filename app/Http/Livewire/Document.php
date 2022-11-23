<?php

namespace App\Http\Livewire;

use App\Models\Document as ModelsDocument;
use Livewire\Component;

class Document extends Component
{
    public $documents;

    public $applicant = null;

    public bool $isEdit = false;

    protected $listeners = ['refreshData'];

    public function mount()
    {
        $this->refreshData();
    }

    public function refreshData()
    {
        $this->applicant = $this->applicant ?: auth()->user();
        if (auth()->user()->hasRole([ROLE_ADMIN, ROLE_EMPLOYEE])) {
            $this->isEdit = true;
        } elseif (auth()->user()->hasRole(ROLE_APPLICANT)) {
            $this->isEdit = $this->applicant->application_status == \App\Enums\ApplicationStatus::TEST_RESULT_PDF_RETRIEVED_ON;
        }

        $this->documents = ModelsDocument::with(['medias' => function ($query) {
            $query->where('user_id', $this->applicant->id);
        }])->whereHas('courses', function ($query) {
            $query->whereIn('course_id', $this->applicant->desiredBeginning->courses->pluck('course_id'));
        })->get();
    }

    public function render()
    {
        return view('livewire.document');
    }
}
