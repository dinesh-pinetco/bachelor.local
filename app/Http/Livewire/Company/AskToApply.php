<?php

namespace App\Http\Livewire\Company;

use App\Enums\ApplicationStatus;
use App\Models\User;
use Livewire\Component;

class AskToApply extends Component
{
    public User $user;

    public function selectCompany()
    {
        if ($this->user->application_status->id() >= ApplicationStatus::APPLYING_TO_SELECTED_COMPANY->id()) {
            return $this->toastNotify(__("You can't access it."), __('Error'), TOAST_ERROR);
        }

        $this->user->update([
            'application_status' => ApplicationStatus::APPLYING_TO_SELECTED_COMPANY(),
        ]);

        return redirect()->route('companies.index');
    }

    public function render()
    {
        return view('livewire.company.ask-to-apply');
    }
}
