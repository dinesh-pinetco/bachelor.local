<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Company extends Component
{
    public $companies;

    public User $applicant;

    public $appliedForCompany = false;

    public $contactedCompanies = [];

    public $rejectedCompanies = [];

    protected $listeners = ['refreshData'];

    public function mount()
    {
        $this->refreshData();

        $this->contactedCompanies = $this->applicant->companies->filter(function ($company) {
            return $company->company_contacted_at;
        });

        $this->rejectedCompanies = $this->applicant->companies->filter(function ($company) {
            return $company->company_rejected_at;
        });
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
