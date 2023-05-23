<?php

namespace App\Http\Livewire\Applicant\Modal;

use App\Http\Livewire\Traits\HasModal;
use App\Models\User;
use App\Services\MakeAnonymousUser;
use Livewire\Component;

class Anonymous extends Component
{
    use HasModal;

    public User $applicant;

    public function toggle(User $user)
    {
        $this->show = ! $this->show;
        $this->applicant = $user;
    }

    public function AnonymousApplicant()
    {
        MakeAnonymousUser::make($this->applicant)->execute();
        $this->emitUp('refresh');
        $this->close();
        $this->toastNotify(__('Applicant has been enrolled successfully.'));

    }

    public function render()
    {
        return view('livewire.applicant.modal.anonymous');
    }
}
