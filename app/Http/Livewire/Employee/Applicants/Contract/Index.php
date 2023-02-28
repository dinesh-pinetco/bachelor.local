<?php

namespace App\Http\Livewire\Employee\Applicants\Contract;

use App\Enums\ApplicationStatus;
use App\Mail\ContractReceived;
use App\Mail\ContractSent;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Index extends Component
{
    public User $applicant;

    public Contract $contract;

    protected $listeners = ['refreshData'];

    protected array $rules = [
        'contract.send_date' => ['required', 'date', 'after_or_equal:today'],
        'contract.receive_date' => ['nullable', 'date', 'after_or_equal:contract.send_date'],
    ];

    public function mount()
    {
        $this->contract = $this->applicant->contract ?? new Contract();
    }

    public function render()
    {
        return view('livewire.employee.applicants.contract.index');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->save();
    }

    public function removeContractDate($dateType)
    {
        $this->contract->{$dateType} = null;
        $this->contract->save();

        $dateType === 'send_date'
            ? $this->toastNotify(__('Contract send date deleted successfully.'), __('Success'), TOAST_SUCCESS)
            : $this->toastNotify(__('Contract received date deleted successfully.'), __('Success'), TOAST_SUCCESS);
    }

    public function save()
    {
        $this->validate(array_merge($this->rules));

        if ($this->applicant->contract === null) {
            $this->applicant->contract()->save($this->contract);
        } else {
            $this->contract->save();
        }

        if ($this->contract->send_date !== null && $this->contract->receive_date == null) {
            $this->applicant->application_status = ApplicationStatus::CONTRACT_SENT_ON;
            Mail::to($this->applicant)->bcc(config('mail.supporter.address'))->send(new ContractSent($this->applicant));
        } elseif ($this->contract->send_date !== null && $this->contract->receive_date !== null) {
            $this->applicant->application_status = ApplicationStatus::CONTRACT_RETURNED_ON;
            Mail::to($this->applicant)->bcc(config('mail.supporter.address'))->send(new ContractReceived($this->applicant));
        }

        $this->applicant->save();

        $this->toastNotify(__('Information saved successfully.'), __('Success'), TOAST_SUCCESS);
    }
}
