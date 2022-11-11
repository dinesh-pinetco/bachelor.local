<?php

namespace App\Http\Livewire\Employee\Applicants\Interviews;

use App\Models\Interview;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Throwable;

class Show extends Component
{
    use AuthorizesRequests;

    public Interview $interview;

    public User $applicant;

    public bool $isEdit = false;

    protected array $rules = [
        'interview.has_taken_placement' => ['required', 'boolean'],
        'interview.comment'             => ['required'],
        'interview.date'                => ['required', 'date'],
    ];

    public function mount()
    {
        try {
            if ($this->applicant->interview !== null && $this->authorizeForUser($this->applicant, 'update', $this->applicant->interview)) {
                $this->isEdit = true;
            } elseif ($this->authorizeForUser($this->applicant, 'create', Interview::class)) {
                $this->isEdit = true;
            }
        } catch (Throwable $th) {
            $this->isEdit = false;
        }

        $this->renderInterview();
    }

    public function renderInterview()
    {
        $this->interview = $this->applicant->interview ?? new Interview();
    }

    public function render()
    {
        return view('livewire.employee.applicants.interviews.show');
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'interview.date' || $propertyName == 'interview.comment') {
            $this->validateOnly($propertyName);

            $this->interview->date = $this->interview->date ?: null;
            $this->save();
            $this->updateApplicantStatus();
        }
    }

    public function save()
    {
        if ($this->applicant->interview === null) {
            $this->authorizeForUser($this->applicant, 'create', Interview::class);
            $this->applicant->interview()->save($this->interview);
        } else {
            $this->authorizeForUser($this->applicant, 'update', $this->interview);
            $this->interview->save();
        }

        $this->toastNotify(__('Information saved successfully.'), __('Success'), TOAST_SUCCESS);
    }

    public function handleHasTakenPlacement()
    {
        if ($this->interview->has_taken_placement) {
            $this->interview->has_taken_placement = (bool) $this->interview->has_taken_placement;

            if (! $this->interview->date) {
                $this->interview->date = Carbon::now()->toDateString();
            }
            $this->save();

            $this->updateApplicantStatus();
        }
    }

    public function removeInterviewDate()
    {
        $this->interview->date = null;
        $this->interview->save();

        $this->toastNotify(__('Interview date deleted successfully.'), __('Success'), TOAST_SUCCESS);
    }

    private function updateApplicantStatus()
    {
        if ($this->applicant->application_status_id == User::STATUS_TEST_TAKEN) {
            $this->applicant->application_status_id = User::STATUS_SELECTION_INTERVIEW_ON;
            $this->applicant->save();
        }
    }
}
