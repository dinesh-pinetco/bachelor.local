<?php

namespace App\Http\Livewire\Company;

use App\Enums\ApplicationStatus;
use App\Mail\ApplyToCompanyMail;
use App\Models\User;
use App\Services\Companies\Companies;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Index extends Component
{
    public $companies = [];

    public $selectedCompanies = [];

    public $mailContent = null;

    public User $user;

    protected $rules = [
        'mailContent' => ['required', 'min:4'],
    ];

    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function mount()
    {
        $this->user = auth()->user();

        if ($this->user->application_status === ApplicationStatus::APPLYING_TO_SELECTED_COMPANY) {
            $this->fetchCompanies();
        }
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
        $this->companies = Companies::make()->get();
    }

    public function applyToSelectedCompany()
    {
        $this->validate();

        if (! count($this->selectedCompanies)) {
            $this->toastNotify(__('Please select at-least one company'), __('Warning'), TOAST_WARNING);
        } else {
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
    }

    public function render()
    {
        return view('livewire.company.index');
    }
}
