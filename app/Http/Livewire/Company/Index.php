<?php

namespace App\Http\Livewire\Company;

use App\Enums\ApplicationStatus;
use App\Models\ApplicantCompany;
use App\Models\Company;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $companies = [];

    public $selectedCompanies = [];

    public $appliedCompanies = [];

    public $mailContent = null;

    public $search = null;

    public $industry = null;

    public $zip_code = null;

    public $showTextarea = false;

    public User $user;

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

        $this->mailContent = auth()->user()?->companies()->first()?->mail_content;

        $this->dispatchBrowserEvent('init-trix-editor');

        $this->selectedCompanies();
    }

    public function selectCompany()
    {
        if (! $this->showAccessDeniedMessage()) {
            return $this->toastNotify(__("You can't access it."), __('Error'), TOAST_ERROR);
        }

        $this->user->update([
            'application_status' => ApplicationStatus::APPLYING_TO_SELECTED_COMPANY(),
        ]);

        $this->fetchCompanies();

        $this->emitSelf('refresh');
    }

    public function directShowProfileOnMarketPlace()
    {
        if (! $this->showAccessDeniedMessage()) {
            return $this->toastNotify(__("You can't access it."), __('Error'), TOAST_ERROR);
        }

        $this->user->update([
            'application_status' => ApplicationStatus::APPLIED_ON_MARKETPLACE(),
        ]);

        auth()->user()->touch('show_application_on_marketplace_at');

        $this->emitSelf('refresh');
    }

    public function showProfileMarketplace()
    {
        auth()->user()->touch('show_application_on_marketplace_at');

        $this->toastNotify(__('You have sent your application to the marketplace.'), __('Success'), TOAST_SUCCESS);

        $this->emitSelf('refresh');
    }

    public function DoNotShowProfileMarketplace()
    {
        auth()->user()->touch('reject_marketplace_application_at');

        $this->selectedCompanies();

        $this->emitSelf('refresh');
    }

    public function selectedCompanies()
    {
        $this->selectedCompanies = auth()->user()->companies()->pluck('company_id')->toArray();
    }

    public function updatedSelectedCompanies()
    {
        $companiesToBeDeleted = array_diff(collect($this->appliedCompanies)->pluck('company_id')?->toArray(), $this->selectedCompanies);

        foreach ($companiesToBeDeleted as $companyId) {
            $this->user->companies()->where('company_id', $companyId)->delete();
        }

        $companiesToBeAdded = array_diff($this->selectedCompanies, collect($this->appliedCompanies)->pluck('company_id')?->toArray());

        foreach ($companiesToBeAdded as $companyId) {
            $this->user->companies()->updateOrCreate([
                'user_id' => $this->user->id,
                'company_id' => $companyId,
            ], [
                'mail_content' => $this->mailContent,
            ]);
        }

        $this->toastNotify(__('Successfully applied to selected company.'), __('Success'), TOAST_SUCCESS);
    }

    protected function fetchAppliedCompanies()
    {
        $this->appliedCompanies = ApplicantCompany::where('user_id', auth()->id())->with('company')->get();
    }

    protected function fetchCompanies()
    {
        $this->companies = Company::when($this->search, function ($query) {
            $query->where('name', 'like', "%$this->search%");
        })
        ->when($this->zip_code, function ($query) {
            $query->where('zip_code', 'like', "$this->zip_code%");
        })
        ->get();

    }

    public function showAccessDeniedMessage()
    {
        return !($this->user->application_status == ApplicationStatus::APPLYING_TO_SELECTED_COMPANY || $this->user->application_status == ApplicationStatus::APPLIED_ON_MARKETPLACE);
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

        foreach ($this->selectedCompanies as $companyId) {
            $this->user->companies()->updateOrCreate([
                'user_id' => $this->user->id,
                'company_id' => $companyId,
            ], [
                'mail_content' => $this->mailContent,
            ]);
        }

        $this->user->update([
            'application_status' => ApplicationStatus::APPLIED_TO_SELECTED_COMPANY(),
        ]);

        $this->toastNotify(__('Successfully applied to selected company.'), __('Success'), TOAST_SUCCESS);

        $this->emitSelf('refresh');
    }

    public function removeCompany($appliedCompanyId)
    {
        if (count($this->user->companies()->get()) <= 1) {
            return $this->toastNotify(__("You can't delete all company."), __('Warning'), TOAST_WARNING);
        }

        $this->user->companies()->where('id', $appliedCompanyId)->delete();

        $this->toastNotify(__('Company deleted successfully.'), __('Success'), TOAST_SUCCESS);

        $this->selectedCompanies();
    }

    public function render()
    {
        $this->fetchCompanies();

        $this->fetchAppliedCompanies();

        return view('livewire.company.index');
    }
}
