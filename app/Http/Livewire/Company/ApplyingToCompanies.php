<?php

namespace App\Http\Livewire\Company;

use App\Enums\ApplicationStatus;
use App\Models\Company;
use App\Models\User;
use Livewire\Component;

class ApplyingToCompanies extends Component
{
    public User $user;

    public bool $showTextarea = false;

    public bool $is_see_test_results = false;

    public string|null $search = null;

    public string|null $zip_code = null;

    public mixed $companies = [];

    public mixed $selectedCompanyIds = [];

    public function mount()
    {
        $this->companies = $this->fetchCompanies();
    }

    public function fetchCompanies()
    {
        return Company::query()->select('id', 'name')->get();
    }

    public function getFilteredCompaniesProperty()
    {
        $companies = $this->companies;

        if ($this->search) {
            $companies = $companies->filter(function ($company) {
                return str_contains(strtolower($company->name), strtolower($this->search));
            });
        }

        if ($this->zip_code) {
            $companies = $companies->filter(function ($company) {
                return str_contains($company->zip_code, $this->zip_code);
            });
        }

        return $companies;
    }

    public function next()
    {
        if (! count($this->selectedCompanyIds)) {
            $this->toastNotify(__('Please select at-least one company!'), '', TOAST_INFO);
        } else {
            $this->showTextarea = true;
        }
    }

    public function applyToSelectedCompany()
    {
        foreach (array_filter($this->selectedCompanyIds) as $companyId) {
            $this->user->companies()->updateOrCreate([
                'user_id' => $this->user->id,
                'company_id' => $companyId,
            ], [
                'is_see_test_results' => $this->is_see_test_results,
            ]);
        }

        if ($this->user->application_status->id() <= ApplicationStatus::APPLYING_TO_SELECTED_COMPANY->id()) {
            $this->user->update([
                'application_status' => ApplicationStatus::APPLIED_TO_SELECTED_COMPANY(),
            ]);
        }

        return redirect()->route('companies.index');
    }

    public function render()
    {
        return view('livewire.company.applying-to-companies');
    }
}
