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

    public $showApplyButton = false;

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

    /**
     * @var array|mixed|null
     */
    public mixed $addNewCompaniesToApplicant;

    public function mount()
    {
        $this->user = auth()->user()->load('companies.company');

        if ($this->user->application_status->id() > ApplicationStatus::TEST_RESULT_PDF_RETRIEVED_ON->id()) {
            $this->initialRender();
        }
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
        $this->filterCompanies = $this->companies->filter(function ($company) {
            return str_contains(strtolower($company->name), strtolower($this->search)) && str_contains($company->zip_code, $this->zip_code);
        });

        if (empty($this->search) && empty($this->zip_code)) {
            $this->filterCompanies = $this->companies;
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

        $this->initialRender();
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

        $this->getSelectedCompanies();

//        $this->emitSelf('refresh');
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

    public function getSelectedCompanies()
    {
        $this->selectedCompanies = $this->user->companies->pluck('company_id')?->toArray();
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
//        $this->fetchAppliedCompanies();

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
            $this->showApplyButton = true;
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

        if ($this->user->application_status->id() <= ApplicationStatus::APPLYING_TO_SELECTED_COMPANY->id()) {
            $this->user->update([
                'application_status' => ApplicationStatus::APPLIED_TO_SELECTED_COMPANY(),
            ]);
        }

        $this->isAppliedToCompany = true;

//        $this->emitSelf('refresh');

        $this->getSelectedCompanies();

        $this->toastNotify(__('Successfully applied to selected company.'), __('Success'), TOAST_SUCCESS);

        $this->show = false;
    }

    public function removeCompany($appliedCompanyId)
    {
        if (count($this->user->companies()->get()) <= 1) {
            $this->getSelectedCompanies();

            return $this->toastNotify(__("You can't delete all company."), __('Warning'), TOAST_WARNING);
        }

        $this->user->companies()->where('company_id', $appliedCompanyId)->first()->delete();

        $this->getSelectedCompanies();
        $this->fetchAppliedCompanies();

        $this->toastNotify(__('Company deleted successfully.'), __('Success'), TOAST_SUCCESS);

//        $this->emitSelf('refresh');
    }

    public function updateCompanies()
    {
        $this->open();
    }

    public function updatedAddNewCompaniesToApplicant()
    {
        $this->selectedCompanies = $this->addNewCompaniesToApplicant;
    }

    public function render()
    {
        return view('livewire.company.index');
    }

    private function initialRender()
    {
        $this->appliedCompanies = $this->user?->companies;

        $this->is_see_test_results = $this->user?->companies?->first()?->is_see_test_results ?? false;

        $this->dispatchBrowserEvent('init-trix-editor');

        $this->filterCompanies = $this->fetchCompanies();
        $this->companies = $this->filterCompanies;

        $this->getSelectedCompanies();

        $this->isAppliedToCompany = $this->appliedCompanies->isNotEmpty();

        $this->marketplacePrivacyPolicyAccepted = $this->user->marketplace_privacy_policy_accepted;

        $this->addNewCompaniesToApplicant = $this?->selectedCompanies;
    }
}
