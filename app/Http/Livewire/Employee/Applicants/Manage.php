<?php

namespace App\Http\Livewire\Employee\Applicants;

use Livewire\Component;

class Manage extends Component
{
    public $applicant;

    public $tab;

    public function render()
    {
        return view('livewire.employee.applicants.manage');
    }
}
