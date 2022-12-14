<?php

namespace App\Http\Livewire\Applicant\Modal;

use App\Http\Livewire\Traits\HasModal;
use App\Models\Course;
use App\Models\User;
use Livewire\Component;

class EnrollApplicant extends Component
{
    use HasModal;

    public User $applicant;

    public $courses = [];

    public bool $isEdit = false;

    public $date_of_birth;

    public $desiredBeginning;

    public function mount()
    {
        $this->courses = Course::active()->get();
    }

    public function render()
    {
        return view('livewire.applicant.modal.enroll-applicant');
    }

    public function toggle(User $user)
    {
        $this->show = ! $this->show;
        $this->applicant = $user;
        $this->date_of_birth=$this->applicant?->values->where('fields.key', 'date_of_birth')->value('value');
        $this->desiredBeginning=$this->applicant?->desiredBeginning->course_start_date->format('F.Y');
    }

    public function enroll(User $user)
    {
        dd('inside enroll');
    }
}
