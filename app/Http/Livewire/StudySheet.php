<?php

namespace App\Http\Livewire;

use App\Models\Course;
use App\Models\HealthInsuranceCompany;
use App\Models\Nationality;
use App\Models\School;
use App\Models\StudySheet as StudySheetModel;
use App\Traits\StudySheetFormValidations;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudySheet extends Component
{
    use StudySheetFormValidations , WithFileUploads, AuthorizesRequests;

    public $applicant;

    public $showThanks = false;

    public StudySheetModel $studySheet;

    public bool $formAlreadySubmitted = false;

    public bool $isGermanUser = false;

    private string $paymentOptionDisableCompany = 'CGI';

    public $schools;

    public $nationalities;

    public $healthInsuranceCompanies;

    public $courseName;

    public $desiredBeginning;

    public string $firstName;

    public string $lastName;

    public string $email;

    public $dateOfBirth;

    public bool $isEdit;

    public function mount()
    {
        $isAuthApplicant = auth()->user()->hasRole(ROLE_APPLICANT);

        $this->studySheet = $this->applicant->study_sheet ?? $this->applicant->study_sheet()->create([
            'user_id' => $this->applicant->id,
        ]);

        $this->formAlreadySubmitted = $this->studySheet->is_submit ?? false;

        if ($isAuthApplicant) {
            $this->showThanks = $this->formAlreadySubmitted;
        }

        $this->schools = School::get();

        $this->healthInsuranceCompanies = HealthInsuranceCompany::active()->get();

        $this->nationalities = Nationality::orderBy('name')->get();

        $this->courseName = Course::where('id', $this->applicant->getValueByField('enroll_course')?->value)->first()?->name;

        $this->dateOfBirth = Carbon::parse($this->applicant->getValueByField('date_of_birth')?->value)->format('d.m.Y');

        $this->desiredBeginning = $this->applicant?->desiredBeginnings->course_start_date->translatedFormat('F Y');

        $this->firstName = $this->applicant->first_name;

        $this->lastName = $this->applicant->last_name;
        $this->email = $this->applicant->email;

        $this->isEdit = ! ($isAuthApplicant && $this->formAlreadySubmitted);
    }

    public function updatedStudySheetStudentIdCardPhoto()
    {
        $this->validate([
            'studySheet.student_id_card_photo' => ['required', 'mimes:jpg,jpeg,png', 'max:10240'],
        ], [], [
            'studySheet.student_id_card_photo' => __('student card photo'),
        ]);
        $this->studySheet->student_id_card_photo = $this->studySheet->student_id_card_photo->store('student-id-photo');
        $this->save();
    }

    public function deletePhoto()
    {
        Storage::delete($this->studySheet->student_id_card_photo);
        $this->studySheet->student_id_card_photo = null;
        $this->studySheet->save();
        $this->emitSelf('refresh');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->save();
    }

    public function save()
    {
        if ($this->applicant->study_sheet == null) {
            $this->applicant->study_sheet()->save($this->studySheet);
        } else {
            if ($this->formAlreadySubmitted) {
                $this->toastNotify(__('Information updated successfully.'), __('Success'), TOAST_SUCCESS);
            }
            $this->studySheet->save();
        }
    }

    public function submit()
    {
        $this->validate($this->rules());

        $this->studySheet->is_submit = true;
        $this->studySheet->save();

        $this->applicant->load(['government_form', 'study_sheet']);

        $this->applicant->enrollApplicant();

        $this->toastNotify(__('Information saved successfully.'), __('Success'), TOAST_SUCCESS);

        $this->showThanks = true;

        $this->isEdit = false;

        $this->formAlreadySubmitted = true;
    }

    public function render(): Factory|View|Application
    {
        $this->authorize('update', $this->studySheet);

        return view('livewire.study-sheet');
    }
}
