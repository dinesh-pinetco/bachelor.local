<?php

namespace App\Http\Livewire\Applicant\Modal;

use App\Http\Livewire\Traits\HasModal;
use App\Models\User;
use Livewire\Component;

class MarkAsFailed extends Component
{
    use HasModal;

    public User $applicant;

    public function render()
    {
        return view('livewire.applicant.modal.mark-as-failed');
    }

    public function toggle(User $user)
    {
        $this->show = ! $this->show;
        $this->applicant = $user;
    }

    public function failed()
    {
        $this->emitUp('markAsFailed');
        $this->emitUp('refresh');
        $this->close();
    }
}
