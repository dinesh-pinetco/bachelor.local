<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Contract extends Component
{
    public User $applicant;

    public function render()
    {
        return view('livewire.contract');
    }
}
