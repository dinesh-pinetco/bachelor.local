<?php

namespace App\Http\Livewire\Applicant\Modal;

use App\Http\Livewire\Traits\HasModal;
use App\Models\User;
use Livewire\Component;

class TestFail extends Component
{
    use HasModal;

    public User $applicant;

    public function render()
    {
        return view('livewire.applicant.modal.test-fail');
    }

    public function toggle(User $user)
    {
        $this->show = ! $this->show;
        $this->applicant = $user;
    }

    public function confirmFail()
    {
        $this->applicant->applicantFailedSelectionTest();
        $this->emitUp('refresh');
        $this->close();
    }
}
