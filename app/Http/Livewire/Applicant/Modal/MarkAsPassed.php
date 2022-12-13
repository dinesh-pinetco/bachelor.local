<?php

namespace App\Http\Livewire\Applicant\Modal;

use App\Http\Livewire\Employee\Applicants\SelectionTests\Show;
use App\Http\Livewire\Traits\HasModal;
use App\Models\Result;
use App\Models\User;
use Livewire\Component;

class MarkAsPassed extends Component
{
    use HasModal;

    public User $applicant;



    public function render()
    {
        return view('livewire.applicant.modal.mark-as-passed');
    }

    public function toggle(User $user)
    {
        $this->show = ! $this->show;
        $this->applicant = $user;
    }

    public function passed()
    {
        $this->emitUp('markAsPassed');
        $this->emitUp('refresh');
        $this->close();
    }
}
