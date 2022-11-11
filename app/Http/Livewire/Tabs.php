<?php

namespace App\Http\Livewire;

use App\Mail\ApplicationApproved;
use App\Models\Result;
use App\Models\Tab;
use App\Models\Test;
use App\Models\University;
use App\Models\User;
use App\Services\Moodle;
use App\Services\ProgressBar;
use App\Traits\Livewire\HasModal;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Tabs extends Component
{
    use HasModal;

    public Collection $tabs;

    public $applicant = null;

    public $selectedStatus;

    public $applicationRejectReason;

    public $nakUniversityId = null;

    public $universityId = null;

    public $grade = null;

    protected array $rules = [
        'applicationRejectReason' => ['required'],
    ];

    public function mount()
    {
        if (auth()->user()->hasRole(ROLE_APPLICANT)) {
            $this->tabs = Tab::where('slug', '<>', 'profile')->get();
        } else {
            $this->tabs = Tab::all();

            $this->nakUniversityId = University::where('name', 'NORDAKADEMIE')->first()->id;

            $universityId = $this->applicant->getValueByField('university');

            $this->universityId = $universityId != null ? $universityId->value : null;

            $grade = $this->applicant->getValueByField('grade');

            $this->grade = $grade != null ? str_replace(',', '.', $grade->value) : null;
        }
    }

    public function render()
    {
        return view('livewire.tabs');
    }

    public function openConfirmModal($status)
    {
        $this->open();
        $this->selectedStatus = $status;
    }

    public function rejectApplication()
    {
        $this->validate();
        $this->applicant->application_status = $this->selectedStatus;
        $this->applicant->application_reject_reason = $this->applicationRejectReason;
        $this->applicant->save();
        $this->toastNotify(__('Application reject successfully.'), __('Success'), TOAST_SUCCESS);

        return redirect(request()->header('Referer'));
    }

    public function resetRejectApplication()
    {
        $this->show = false;
        $this->resetValidation();
        $this->selectedStatus = null;
        $this->applicationRejectReason = null;
    }

    public function approveApplication()
    {
        $error = null;

        $overAllProgress = (new ProgressBar($this->applicant->id))->overAllProgress();
        if ($overAllProgress != 100) {
            $error = __('Please fill the required field.');
        }

        if ($this->applicant->media->where('is_check', 0)->count() > 0) {
            $error = __('Please check the document');
        }

        if (is_null($error) && $this->nakUniversityId == $this->universityId && $this->grade <= 2.5) {
            $this->applicant->application_status = USER::STATUS_TEST_TAKEN;
            $this->applicant->save();
            Mail::to($this->applicant->email)->bcc(config('mail.supporter.address'))
                ->send(new ApplicationApproved($this->applicant, is_test_taken: true));
            $this->toastNotify(__('Approval mail sent successfully to the applicant!!'), __('Success'), TOAST_SUCCESS);
        } elseif (is_null($error)) {
            $tests = Test::whereHas('courses', function ($query) {
                $query->whereIn('course_id', $this->applicant->courses->pluck('id'));
            })->get();

            foreach ($tests as $test) {
                if ($test->type == Test::TYPE_MOODLE) {
                    $error = (new Moodle($this->applicant))->createUser();
                } elseif ($test->type == Test::TYPE_CUBIA) {
                    $this->applicant->saveCubiaId();
                    $this->createInitialResult($test->id);
                } elseif ($test->type == Test::TYPE_METEOR) {
                    $this->applicant->saveMeteorId();
                    $this->createInitialResult($test->id);
                }
            }

            if (is_null($error)) {
                Mail::to($this->applicant->email)->bcc(config('mail.supporter.address'))->send(new ApplicationApproved($this->applicant));
                $this->applicant->application_status = USER::STATUS_APPLICATION_ACCEPTED;
                $this->applicant->save();
                $this->toastNotify(__('Approval mail sent successfully to the applicant!!'), __('Success'), TOAST_SUCCESS);
            }
        }

        if ($error) {
            $this->toastNotify($error, __('Error'), TOAST_ERROR);
        } else {
            return redirect(request()->header('Referer'));
        }
    }

    public function createInitialResult($testId)
    {
        Result::updateOrCreate(
            ['user_id' => $this->applicant->id, 'test_id' => $testId],
            ['status' => Result::STATUS_NOT_STARTED]
        );
    }
}
