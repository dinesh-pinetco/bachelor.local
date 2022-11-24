<?php

namespace App\Http\Livewire;

use App\Enums\ApplicationStatus;
use App\Http\Livewire\Traits\HasModal;
use App\Models\User;
use Livewire\Component;

class ApplicationReject extends Component
{
    use HasModal;

    public User $applicant;

    public $applicationRejectReason;

    public $selectedStatus;

    protected array $rules = [
        'applicationRejectReason' => ['required'],
    ];

    public function render()
    {
        return view('livewire.application-reject');
    }

    public function toggle(User $applicant)
    {
        $this->show = ! $this->show;
        $this->applicant = $applicant->load('configuration');

        if (in_array($this->applicant->application_status, [ApplicationStatus::APPLICATION_REJECTED_BY_APPLICANT, ApplicationStatus::APPLICATION_REJECTED_BY_NAK])) {
            $this->applicationRejectReason = $this->applicant->configuration?->application_reject_reason;
        }
    }

    public function reject()
    {
        $this->validate();
        $this->applicant->application_status = ApplicationStatus::APPLICATION_REJECTED_BY_APPLICANT;
        $this->applicant->is_active = false;
        $this->applicant->save();

        $this->applicant->configuration()
            ->updateOrCreate(['application_reject_reason' => $this->applicationRejectReason]);

        $this->toastNotify(__('Application reject successfully.'), __('Success'), TOAST_SUCCESS);

        return redirect(request()->header('Referer'));
    }

    public function cancel()
    {
        $this->show = false;
        $this->resetValidation();
        $this->selectedStatus = null;
        $this->applicationRejectReason = null;
    }
}
