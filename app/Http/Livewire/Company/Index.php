<?php

namespace App\Http\Livewire\Company;

use App\Enums\ApplicationStatus;
use App\Models\Company;
use App\Models\User;
use App\Traits\Livewire\HasModal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Index extends Component
{
    use HasModal, AuthorizesRequests;

    public $companies;

    public $selectedCompanies = [];

    public $appliedCompanies = [];

    public $is_see_test_results = false;

    public $search = null;

    public $zip_code = null;

    public $showTextarea = false;

    public User $user;

    public bool $isAppliedToCompany = true;

    public $marketplacePrivacyPolicyAccepted = false;

    public $filterCompanies = [];

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'zip_code' => ['except' => ''],
    ];

    public function mount()
    {
        $this->user = auth()->user()->load('companies.company');

        $this->appliedCompanies = $this->user?->companies;

        $this->is_see_test_results = $this->user?->companies()->first()?->is_see_test_results ?? false;

        $this->dispatchBrowserEvent('init-trix-editor');

        $this->companies = $this->fetchCompanies();

        $this->selectedCompanies();

        $this->isAppliedToCompany = $this->appliedCompanies->isNotEmpty();

        $this->marketplacePrivacyPolicyAccepted = $this->user->marketplace_privacy_policy_accepted;
    }

    public function updatedSearch()
    {
        $this->getFilteredCompanies();
    }

    public function updatedZipCode()
    {
        $this->getFilteredCompanies();
    }

    public function getFilteredCompanies()
    {
        $this->companies = Company::query()
            ->when(! empty($this->search), function ($query) {
                return $query->searchByName($this->search);
            })
            ->when(! empty($this->zip_code), function ($query) {
                return $query->where('zip_code', $this->zip_code);
            })
            ->get();

        if (empty($this->search) && empty($this->zip_code)) {
            $this->fetchCompanies();
        }
    }

    public function selectCompany()
    {
        if ($this->user->application_status->id() >= ApplicationStatus::APPLYING_TO_SELECTED_COMPANY->id()) {
            return $this->toastNotify(__("You can't access it."), __('Error'), TOAST_ERROR);
        }

        $this->user->update([
            'application_status' => ApplicationStatus::APPLYING_TO_SELECTED_COMPANY(),
        ]);

        $this->emitSelf('refresh');
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

        $this->selectedCompanies();

        $this->emitSelf('refresh');
    }

    public function selectedCompanies()
    {
        $this->selectedCompanies = $this->appliedCompanies?->pluck('company_id')?->toArray();
    }

    public function updatedSelectedCompanies()
    {
        if ($this->isAppliedToCompany) {
            $companiesToBeDeleted = array_diff(collect($this->appliedCompanies)->pluck('company_id')?->toArray(), $this->selectedCompanies);

            if (count($companiesToBeDeleted)) {
                $this->removeCompany(array_first($companiesToBeDeleted));
            } else {
                $companiesToBeAdded = array_diff($this->selectedCompanies, collect($this->appliedCompanies)->pluck('company_id')?->toArray());

                $this->user->companies()->updateOrCreate([
                    'user_id' => $this->user->id,
                    'company_id' => array_first($companiesToBeAdded),
                ]);

                $this->toastNotify(__('Successfully applied to selected company.'), __('Success'), TOAST_SUCCESS);
            }
        }
    }

    protected function fetchAppliedCompanies()
    {
        $this->appliedCompanies = $this->user->companies()->with('company')->get();
    }

    protected function fetchCompanies()
    {
        return Company::all();
    }

    public function showAccessDeniedMessage()
    {
        return $this->user->reject_marketplace_application_at || $this->user->show_application_on_marketplace_at;
    }

    public function next()
    {
        if (! count($this->selectedCompanies)) {
            $this->toastNotify(__('Please select at-least one company!'), '', TOAST_INFO);
        } else {
            $this->showTextarea = true;

            $this->dispatchBrowserEvent('init-trix-editor');
        }
    }

    public function applyToSelectedCompany()
    {
        foreach (array_filter($this->selectedCompanies) as $companyId) {
            $this->user->companies()->updateOrCreate([
                'user_id' => $this->user->id,
                'company_id' => $companyId,
            ], [
                'is_see_test_results' => $this->is_see_test_results,
            ]);
        }

        if ($this->user->application_status->id() < ApplicationStatus::ENROLLMENT_ON->id()) {
            $this->user->update([
                'application_status' => ApplicationStatus::APPLIED_TO_SELECTED_COMPANY(),
            ]);
        }

        $this->isAppliedToCompany = true;

        $this->selectedCompanies();

        $this->toastNotify(__('Successfully applied to selected company.'), __('Success'), TOAST_SUCCESS);

        $this->emitSelf('refresh');
    }

    public function removeCompany($appliedCompanyId)
    {
        if (count($this->user->companies()->get()) <= 1) {
            $this->selectedCompanies();

            return $this->toastNotify(__("You can't delete all company."), __('Warning'), TOAST_WARNING);
        }

        $this->user->companies()->where('company_id', $appliedCompanyId)->first()->delete();

        $this->selectedCompanies();

        $this->toastNotify(__('Company deleted successfully.'), __('Success'), TOAST_SUCCESS);
    }

    public function updateCompanies()
    {
        $this->open();
    }

    public function render()
    {
        $this->authorize('view', User::class);

        $this->fetchAppliedCompanies();

        return view('livewire.company.index');
    }
}
