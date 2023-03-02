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

        $this->appliedCompanies = ApplicantCompany::where('user_id', auth()->id())->get();

        $this->mailContent = auth()->user()?->companies()->first()?->mail_content;

        $this->dispatchBrowserEvent('init-trix-editor');
    }

    public function selectCompany()
    {
        $this->user->update([
            'application_status' => ApplicationStatus::APPLYING_TO_SELECTED_COMPANY(),
        ]);

        $this->fetchCompanies();

        $this->emitSelf('refresh');
    }

    public function showProfileMarketplace()
    {
        auth()->user()->touch('show_application_on_marketplace_at');

        $this->emitSelf('refresh');
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

        if (! is_null($this->appliedCompanies)) {
            foreach ($this->appliedCompanies as $key => $company) {
                $this->user->companies()->updateOrCreate([
                    'user_id' => $this->user->id,
                    'sanna_id' => $key,
                ], [
                    'company_name' => $company->company_name,
                    'mail_content' => $this->mailContent,
                ]);
            }
        }

        foreach ($this->selectedCompanies as $key => $company) {
            $this->user->companies()->updateOrCreate([
                'user_id' => $this->user->id,
                'sanna_id' => $key,
            ], [
                'company_name' => $company,
                'mail_content' => $this->mailContent,
            ]);
        }

        $this->user->update([
            'application_status' => ApplicationStatus::APPLIED_TO_SELECTED_COMPANY(),
        ]);

        $this->toastNotify(__('Successfully applied to selected company.'), __('Success'), TOAST_SUCCESS);

        $this->dispatchBrowserEvent('refresh-page');
    }

    public function removeCompany($appliedCompanyId)
    {
        if (count($this->user->companies()->get()) <= 1) {
            return $this->toastNotify(__("You can't delete all company."), __('Warning'), TOAST_WARNING);
        }

        $this->user->companies()->where('id', $appliedCompanyId)->delete();

        $this->toastNotify(__('Company deleted successfully.'), __('Success'), TOAST_SUCCESS);

        $this->emitSelf('refresh');
    }

    public function render()
    {
        if ($this->user->application_status === ApplicationStatus::APPLYING_TO_SELECTED_COMPANY) {
            $this->fetchCompanies();
        }

        return view('livewire.company.index');
    }
}
