<?php

namespace App\Http\Livewire;

use App\Mail\GovernmentStudySheetSubmit;
use App\Models\HealthInsuranceCompany;
use App\Models\Nationality;
use App\Models\School;
use App\Models\StudySheet as StudySheetModel;
use App\Traits\StudySheetFormValidations;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudySheet extends Component
{
    use StudySheetFormValidations , WithFileUploads;

    public $applicant;

    public StudySheetModel $studySheet;

    public bool $formAlreadySubmitted = false;

    public bool $isGermanUser = false;

    private string $paymentOptionDisableCompany = 'CGI';

    public $schools;

    public $nationalities;

    public $healthInsuranceCompanies;

    public $coursesNames;

    public $desiredBeginning;

    public string $firstName;

    public string $lastName;

    public string $email;

    public function mount()
    {
        $this->studySheet = $this->applicant->study_sheet ?? new StudySheetModel();

        $this->formAlreadySubmitted = $this->studySheet->is_submit ?? false;

        $this->schools = School::get();

        $this->healthInsuranceCompanies = HealthInsuranceCompany::active()->get();

        $this->nationalities = Nationality::orderBy('name')->get();

        $this->coursesNames = $this->applicant->coursesName();

        $this->desiredBeginning = $this->applicant?->desiredBeginning->course_start_date->format('F.Y');

        $this->firstName = $this->applicant->first_name;

        $this->lastName = $this->applicant->last_name;
        $this->email = $this->applicant->email;
    }

    public function updatedStudySheetStudentIdCardPhoto()
    {

        $this->validate([
            'studySheet.student_id_card_photo'  => ['required', 'mimes:jpg,jpeg,png', 'max:10240'],
        ],[],[
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
            $this->studySheet->save();
        }
    }

    public function submit()
    {
        $this->validate($this->rules());

        $this->studySheet->is_submit = true;
        $this->studySheet->save();

        $this->applicant->load(['government_form', 'study_sheet']);

        if ($this->applicant->government_form?->is_submit && $this->applicant->study_sheet?->is_submit) {
            Mail::to(config('mail.supporter.address'))->send(new GovernmentStudySheetSubmit($this->applicant));
        }

        $this->toastNotify(__('Information saved successfully.'), __('Success'), TOAST_SUCCESS);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.study-sheet');
    }
}
