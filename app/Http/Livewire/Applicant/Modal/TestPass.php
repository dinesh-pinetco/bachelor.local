<?php

namespace App\Http\Livewire\Applicant\Modal;

use App\Http\Livewire\Traits\HasModal;
use App\Models\Result;
use App\Models\User;
use Livewire\Component;

class TestPass extends Component
{
    use HasModal;

    public User $applicant;

    public function render()
    {
        return view('livewire.applicant.modal.test-pass');
    }

    public function toggle(User $user)
    {
        $this->show = ! $this->show;
        $this->applicant = $user;
    }

    public function markAsPass()
    {
        // Mark as pass on failed tests
        Result::myResults($this->applicant)
            ->where('is_passed', false)
            ->update([
                'is_passed' => true,
                'passed_by_nak' => true,
            ]);

        $this->applicant->saveApplicationStatus();
        $this->emitUp('refresh');
        $this->close();
    }
}
