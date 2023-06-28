<?php

namespace App\Http\Livewire\Company;

use App\Models\User;
use Livewire\Component;

class ApplicationOnMarketplace extends Component
{
    public User $user;

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function getAppliedCompaniesProperty()
    {
        return $this->user->companies()->with('company')->get();
    }

    public function showAccessDeniedMessage()
    {
        return $this->user->reject_marketplace_application_at || $this->user->show_application_on_marketplace_at;
    }

    public function showProfileMarketplace()
    {
        if ($this->showAccessDeniedMessage()) {
            return $this->toastNotify(__("You can't access it."), __('Error'), TOAST_ERROR);
        }

        if (! $this->marketplacePrivacyPolicyAccepted) {
            return $this->toastNotify(__('Please agree to the privacy policy to continue.'), __('Error'), TOAST_ERROR);
        }

        $this->user->update([
            'marketplace_privacy_policy_accepted' => $this->marketplacePrivacyPolicyAccepted,
        ]);

        $this->user->touch('show_application_on_marketplace_at');

        $this->toastNotify(__('You have sent your application to the marketplace.'), __('Success'), TOAST_SUCCESS);

        return to_route('application.index', ['tab' => 'industries']);
    }

    public function doNotShowProfileMarketplace()
    {
        if ($this->showAccessDeniedMessage()) {
            return $this->toastNotify(__("You can't access it."), __('Error'), TOAST_ERROR);
        }

        $this->user->touch('reject_marketplace_application_at');

        return redirect()->route('companies.index');
    }

    public function render()
    {
        return view('livewire.company.application-on-marketplace');
    }
}
