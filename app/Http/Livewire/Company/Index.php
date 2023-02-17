<?php

namespace App\Http\Livewire\Company;

use App\Enums\ApplicationStatus;
use App\Models\Company;
use App\Models\User;
use App\Services\Companies\Companies;
use Livewire\Component;

class Index extends Component
{
    public $companies = [];

    public $selectedCompanies = [];

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
        'search' => [ 'except' => ''],
        'zip_code' => [ 'except' => ''],
        'industry' => [ 'except' => ''],
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function selectCompany()
    {
        $this->user->update([
            'application_status' => ApplicationStatus::APPLYING_TO_SELECTED_COMPANY(),
        ]);

        $this->fetchCompanies();
    }

    public function showProfileMarketplace()
    {
        $this->user->update([
            'application_status' => ApplicationStatus::SHOW_APPLICATION_ON_MARKETPLACE(),
        ]);
    }

    protected function fetchCompanies()
    {
        $this->companies = Company::when($this->search, function($query) {
            $query->where('name', 'like',  "%$this->search%");
        })
        ->when($this->zip_code, function($query) {
            $query->where('zip_code', 'like',  "$this->zip_code%");
        })
        ->get();
    }

    public function next()
    {
        if(!count($this->selectedCompanies)) {
            $this->toastNotify(__('Please select at-least one company!'), '', TOAST_INFO);
        } else {
            $this->showTextarea = true;

            $this->dispatchBrowserEvent('init-trix-editor');
        }
    }

    public function applyToSelectedCompany()
    {
        $this->validate();

        foreach ($this->companies as $company) {
            $this->user->companies()->updateOrCreate([
                'user_id' => $this->user->id,
                'company_id' => $company['id'],
            ], [
                'company_name' => $company['name'],
                'mail_content' => $this->mailContent,
            ]);

            // TOD: Send mail to company when email is available in API
            // Mail::to('shubham@pinetco.com')
            //     ->bcc(config('mail.supporter.address'))
            //     ->send(new ApplyToCompanyMail($this->mailContent));
        }

        $this->user->update([
            'application_status' => ApplicationStatus::APPLIED_TO_SELECTED_COMPANY(),
        ]);

        $this->reset(['selectedCompanies', 'mailContent']);

        $this->dispatchBrowserEvent('reset-mail-content');

        $this->toastNotify(__('Successfully applied to selected company.'), __('Success'), TOAST_SUCCESS);

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
