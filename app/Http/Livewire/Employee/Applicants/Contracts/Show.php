<?php

namespace App\Http\Livewire\Employee\Applicants\Contracts;

use App\Mail\ContractReceived;
use App\Mail\ContractSent;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Throwable;

class Show extends Component
{
    use AuthorizesRequests;

    public Contract $contract;

    public User $applicant;

    public bool $isEdit = false;

    protected array $rules = [
        'contract.send_date'    => ['required', 'date'],
        'contract.receive_date' => ['nullable', 'date', 'after_or_equal:contract.send_date'],
    ];

    public function mount()
    {
        try {
            if ($this->applicant->contract !== null && $this->authorizeForUser($this->applicant, 'update', $this->applicant->contract)) {
                $this->isEdit = true;
            } elseif ($this->authorizeForUser($this->applicant, 'create', Contract::class)) {
                $this->isEdit = true;
            }
        } catch (Throwable $th) {
            $this->isEdit = false;
        }

        $this->contract = $this->applicant->contract ?? new Contract();
    }

    public function render()
    {
        return view('livewire.employee.applicants.contracts.show');
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
        $this->validate(array_merge($this->rules, ['contract.send_date' => ['required', 'date', 'after_or_equal:'.$this->applicant->interview->date]]));

        if ($this->applicant->contract === null) {
            $this->applicant->contract()->save($this->contract);
        } else {
            $this->contract->save();
        }

        if ($this->contract->send_date !== null && $this->contract->receive_date == null) {
            $this->applicant->application_status_id = User::STATUS_CONTRACT_SENT_ON;
            Mail::to($this->applicant)->bcc(config('mail.supporter.address'))->send(new ContractSent($this->applicant));
        } elseif ($this->contract->send_date !== null && $this->contract->receive_date !== null) {
            $this->applicant->application_status_id = User::STATUS_CONTRACT_RETURNED_ON;
            Mail::to($this->applicant)->bcc(config('mail.supporter.address'))->send(new ContractReceived($this->applicant));
        }

        $this->applicant->save();
        $this->toastNotify(__('Information saved successfully.'), __('Success'), TOAST_SUCCESS);

        $this->render();
    }
}
