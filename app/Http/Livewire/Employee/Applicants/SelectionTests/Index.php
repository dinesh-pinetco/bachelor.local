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
        $courses = $this->applicant->courses->pluck('id')->toArray();

        $this->tests = Test::matchCourses($courses)->get();

        if ($this->applicant->results->count() > 0) {
            $this->isShow = true;
        }
    }

    public function render()
    {
        return view('livewire.employee.applicants.selection-tests.index');
    }
}
