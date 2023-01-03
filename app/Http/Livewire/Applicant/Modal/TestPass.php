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
            ->update([
                'is_passed' => true,
                'passed_by_nak' => true,
                'status' => Result::STATUS_COMPLETED,
            ]);

        $this->applicant->saveApplicationStatus();
        $this->emitUp('refresh');
        $this->close();
        $this->toastNotify(__('Applicant has been passed successfully.'));
    }

    public function markAsFail()
    {
        // Mark as pass on failed tests
        Result::myResults($this->applicant)
            ->update([
                'is_passed' => false,
                'failed_by_nak' => true,
                'status' => Result::STATUS_FAILED,
            ]);

        $this->applicant->saveApplicationStatus();
        $this->emitUp('refresh');
        $this->close();
        $this->toastNotify(__('Applicant has been failed successfully.'));
    }
}
