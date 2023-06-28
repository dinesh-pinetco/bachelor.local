<?php

namespace App\Http\Livewire\Company;

use App\Models\User;
use Livewire\Component;

class ApplicationOnMarketplace extends Component
{
    public User $user;

    public function getAppliedCompaniesProperty()
    {
        return $this->user->companies()->with('company')->get();
    }

    public function render()
    {
        return view('livewire.company.application-on-marketplace');
    }
}
