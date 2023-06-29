<?php

namespace App\Http\Livewire\Company;

use App\Enums\ApplicationStatus;
use App\Models\ApplicantCompany;
use App\Models\Company;
use App\Models\User;
use App\Traits\Livewire\HasModal;
use Livewire\Component;

class ApplicationToCompany extends Component
{
    use HasModal;

    public User $user;

    public $selectedCompanies = [];

    public $companies = [];

    public bool $is_see_test_results = false;

    public $marketplacePrivacyPolicyAccepted;

    public function mount()
    {
        $this->marketplacePrivacyPolicyAccepted = $this->user->marketplace_privacy_policy_accepted;

        $this->is_see_test_results = $this->user?->companies?->first()?->is_see_test_results ?? false;

        $this->companies = Company::query()->select('id', 'name')->get();

        $this->selectedCompanies = $this->user->companies->pluck('company_id')?->toArray();
    }

    public function removeCompany($appliedCompanyId)
    {

        if (count($this->user->companies()->get()) <= 1) {
            return $this->toastNotify(__("You can't delete all company."), __('Warning'), TOAST_WARNING);
        }

        ApplicantCompany::where('user_id', $this->user->id)->where('company_id', $appliedCompanyId)->delete();

        $index = array_search($appliedCompanyId, $this->selectedCompanies);

        if ($index !== false) {
            array_splice($this->selectedCompanies, $index, 1);
        }

        $this->toastNotify(__('Company deleted successfully.'), __('Success'), TOAST_SUCCESS);
    }

    public function updateCompanies()
    {
        $this->open();
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

        if ($this->user->application_status->id() <= ApplicationStatus::APPLYING_TO_SELECTED_COMPANY->id()) {
            $this->user->update([
                'application_status' => ApplicationStatus::APPLIED_TO_SELECTED_COMPANY(),
            ]);
        }

        $this->toastNotify(__('Successfully applied to selected company.'), __('Success'), TOAST_SUCCESS);

        $this->show = false;
    }

    public function getAppliedCompaniesProperty()
    {
        return collect($this->companies)->whereIn('id', $this->selectedCompanies)->all();
    }

    public function showProfileMarketplace()
    {
        $this->user->update([
            'marketplace_privacy_policy_accepted' => $this->marketplacePrivacyPolicyAccepted,
        ]);

        $this->user->touch('show_application_on_marketplace_at');

        $this->toastNotify(__('You have sent your application to the marketplace.'), __('Success'), TOAST_SUCCESS);

        return to_route('application.index', ['tab' => 'industries']);
    }

    public function doNotShowProfileMarketplace()
    {
        $this->user->touch('reject_marketplace_application_at');

        return redirect()->route('companies.index');
    }

    public function enrollIntoMarketPlace(bool $enroll)
    {
        if ($enroll) {
            $this->marketplacePrivacyPolicyAccepted = true;
            $this->user->reject_marketplace_application_at = null;
            $this->user->save();
            $this->showProfileMarketplace();
        } else {
            $this->user->marketplace_privacy_policy_accepted = false;
            $this->user->show_application_on_marketplace_at = null;
            $this->user->save();
            $this->doNotShowProfileMarketplace();
        }
    }

    public function render()
    {
        return view('livewire.company.application-to-company');
    }
}
