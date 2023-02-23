<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Company extends Component
{
    public $companies;

    public User $applicant;

    public $appliedForCompany = false;

    protected $listeners = ['refreshData'];

    public function mount()
    {
        $this->refreshData();
    }

    public function refreshData()
    {
        $this->companies = $this->applicant->companies()->get();
    }

    public function render()
    {
        return view('livewire.company');
    }
}
