<?php

namespace App\Http\Livewire\Company;

use App\Enums\ApplicationStatus;
use App\Models\Company;
use App\Models\User;
use App\Traits\Livewire\HasModal;
use Livewire\Component;

class Index extends Component
{
    use HasModal;

    public $companies = [];

    public $selectedCompanies = [];

    public $appliedCompanies = [];

    public $mailContent = null;

    public $is_see_test_results = false;

    public $search = null;

    public $industry = null;

    public $zip_code = null;

    public $showTextarea = false;

    public User $user;

    public bool $isAppliedToCompany = true;

    public $applicantCompany = [];

    public $marketplacePrivacyPolicyAccepted = false;

    protected $rules = [
        'mailContent' => ['required', 'min:4'],
    ];

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'zip_code' => ['except' => ''],
        'industry' => ['except' => ''],
    ];

    public function mount()
    {
        $this->user = auth()->user();

        $this->mailContent = $this->user?->companies()->first()?->mail_content;
        $this->is_see_test_results = $this->user?->companies()->first()?->is_see_test_results ?? false;

        $this->dispatchBrowserEvent('init-trix-editor');

        $this->companies = $this->fetchCompanies();

        $this->selectedCompanies();

        $this->applicantCompany = $this->user->companies;

        $this->isAppliedToCompany = $this->user->companies()->exists();

        $this->marketplacePrivacyPolicyAccepted = $this->user->marketplace_privacy_policy_accepted;
    }

    public function selectCompany()
    {
        if (! $this->showAccessDeniedMessage()) {
            return $this->toastNotify(__("You can't access it."), __('Error'), TOAST_ERROR);
        }

        $this->user->update([
            'application_status' => ApplicationStatus::APPLYING_TO_SELECTED_COMPANY(),
        ]);

        $this->companies;

        $this->emitSelf('refresh');
    }

    public function showProfileMarketplace()
    {
        if ($this->marketplacePrivacyPolicyAccepted == false) {
            return $this->toastNotify(__('Please agree to the privacy policy to continue.'), __('Error'), TOAST_ERROR);
        }

        $this->user->marketplace_privacy_policy_accepted = $this->marketplacePrivacyPolicyAccepted;

        $this->user->save();

        $this->user->touch('show_application_on_marketplace_at');

        $this->toastNotify(__('You have sent your application to the marketplace.'), __('Success'), TOAST_SUCCESS);

        $this->emitSelf('refresh');
    }

    public function DoNotShowProfileMarketplace()
    {
        $this->user->touch('reject_marketplace_application_at');

        $this->selectedCompanies();

        $this->emitSelf('refresh');
    }

    public function selectedCompanies()
    {
        $this->selectedCompanies = $this->user->companies()->pluck('company_id')->toArray();
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
                ], [
                    'mail_content' => $this->mailContent,
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
        return Company::when($this->search, function ($query) {
            $query->where('name', 'like', "%$this->search%");
        })
        ->when($this->zip_code, function ($query) {
            $query->where('zip_code', 'like', "$this->zip_code%");
        })
        ->get();
    }

    public function showAccessDeniedMessage()
    {
        return ! ($this->user->application_status == ApplicationStatus::APPLYING_TO_SELECTED_COMPANY || $this->user->application_status == ApplicationStatus::APPLIED_ON_MARKETPLACE);
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
        $this->validate();

        foreach (array_filter($this->selectedCompanies) as $companyId) {
            $this->user->companies()->updateOrCreate([
                'user_id' => $this->user->id,
                'company_id' => $companyId,
            ], [
                'mail_content' => $this->mailContent,
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
        $this->fetchAppliedCompanies();

        return view('livewire.company.index');
    }
}
