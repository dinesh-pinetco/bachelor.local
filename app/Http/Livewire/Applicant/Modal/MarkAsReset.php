<?php

namespace App\Http\Livewire\Applicant\Modal;

use App\Http\Livewire\Traits\HasModal;
use App\Models\User;
use Livewire\Component;

class MarkAsReset extends Component
{
    use HasModal;

    public User $applicant;

    public function render()
    {
        return view('livewire.applicant.modal.mark-as-reset');
    }

    public function toggle(User $user)
    {
        $this->show = ! $this->show;
        $this->applicant = $user;
    }

    public function resetTest()
    {
        $this->emitUp('markAsReset');
        $this->emitUp('refresh');
        $this->close();
    }
}
