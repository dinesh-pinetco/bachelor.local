<?php

namespace App\Http\Livewire\Employee\Applicants\SelectionTests;

use App\Models\Test;
use Illuminate\Support\Collection;
use Livewire\Component;

class Index extends Component
{
    public Collection $tests;

    public $applicant;

    public bool $isShow = false;

    public function mount()
    {
        $this->tests = Test::matchCourses($this->applicant->courses->pluck('course_id'))->get();

        if ($this->applicant->results->count() > 0) {
            $this->isShow = true;
        }
    }

    public function render()
    {
        return view('livewire.employee.applicants.selection-tests.index');
    }
}
