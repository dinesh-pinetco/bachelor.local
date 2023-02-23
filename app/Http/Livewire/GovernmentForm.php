<?php

namespace App\Http\Livewire;

use App\Enums\ApplicationStatus;
use App\Mail\GovernmentStudySheetSubmit;
use App\Models\CourseOfStudy;
use App\Models\District;
use App\Models\EntranceQualification;
use App\Models\FinalExam;
use App\Models\GovernmentForm as GovernmentFormModel;
use App\Models\Nationality;
use App\Models\State;
use App\Models\StudyProgram;
use App\Models\StudyType;
use App\Models\University;
use App\Models\User;
use App\Traits\GovernmentFormValidations;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;

class GovernmentForm extends Component
{
    use GovernmentFormValidations;

    public User $applicant;

    public GovernmentFormModel $governmentForm;

    public bool $formAlreadySubmitted = false;

    //    public $universities;
    //
    //    public $studyPrograms;
    //
    //    public $finalExams;
    //
    //    public $entranceQualifications;
    //
    //    public $courseOfStudies;
    //
    //    public $studyTypes;

    public bool $isGermanUser = false;

    public $nationalities;

    public $states;

    public $previousResidenceStates;

    public $previousResidenceDistrict;

    public $currentResidenceStates;

    public $currentResidenceDistrict;

    public $graduationStates;

    public $graduationDistrict;

    public function mount()
    {
        $countryOfBirth = $this->applicant->getValueByField('nationality_id');
        if ($countryOfBirth) {
            $germanCountry = Nationality::where('name', 'Deutschland')->first();
            $this->isGermanUser = $countryOfBirth->value == $germanCountry->id;
        }

        $this->governmentForm = $this->applicant->government_form ?? new GovernmentFormModel();
        $this->formAlreadySubmitted = $this->governmentForm->is_submit ?? false;
        //        $this->universities           = University::orderBy('name')->get();
        //        $this->studyPrograms          = StudyProgram::orderBy('name')->get();
        //        $this->finalExams             = FinalExam::orderBy('name')->get();
        //        $this->entranceQualifications = EntranceQualification::orderBy('name')->get();
        //        $this->courseOfStudies        = CourseOfStudy::orderBy('name')->get();
        //        $this->studyTypes             = StudyType::orderBy('name')->get();

        $this->nationalities = Nationality::orderBy('name')->get();
        $this->states = State::orderBy('name')->get();
        $this->refreshPreviousResidenceCountryData();
        $this->refreshCurrentResidenceCountryData();
        $this->refreshGraduationCountryData();
    }

    public function getUniversitiesProperty(): Collection
    {
        return University::orderBy('name')->get();
    }

    public function getStudyProgramsProperty(): Collection
    {
        return StudyProgram::orderBy('name')->get();
    }

    public function getFinalExamsProperty(): Collection
    {
        return FinalExam::orderBy('name')->get();
    }

    public function getEntranceQualificationsProperty(): Collection
    {
        return EntranceQualification::orderBy('name')->get();
    }

    public function getCourseOfStudiesProperty(): Collection
    {
        return CourseOfStudy::orderBy('name')->get();
    }

    public function getStudyTypesProperty(): Collection
    {
        return StudyType::orderBy('name')->get();
    }

    public function refreshPreviousResidenceCountryData($propertyName = null)
    {
        if ($propertyName == 'governmentForm.previous_residence_state_id') {
            $this->governmentForm->previous_residence_district_id = null;
        } else {
            if ($this->governmentForm->previous_residence_country_id != 1) {
                $this->governmentForm->previous_residence_state_id = null;
                $this->governmentForm->previous_residence_district_id = null;
            }
            $this->previousResidenceStates = $this->governmentForm->previous_residence_country_id == 1 ? $this->states
                : new Collection();
        }
        $this->previousResidenceDistrict = District::orderBy('name')
            ->where('state_id', $this->governmentForm->previous_residence_state_id)->get();
    }

    public function refreshCurrentResidenceCountryData($propertyName = null)
    {
        if ($propertyName == 'governmentForm.current_residence_state_id') {
            $this->governmentForm->current_residence_district_id = null;
        } else {
            if ($this->governmentForm->current_residence_country_id != 1) {
                $this->governmentForm->current_residence_state_id = null;
                $this->governmentForm->current_residence_district_id = null;
            }
            $this->currentResidenceStates = $this->governmentForm->current_residence_country_id == 1 ? $this->states
                : new Collection();
        }
        $this->currentResidenceDistrict = District::orderBy('name')
            ->where('state_id', $this->governmentForm->current_residence_state_id)->get();
    }

    public function refreshGraduationCountryData($propertyName = null)
    {
        if ($propertyName == 'governmentForm.graduation_state_id') {
            $this->governmentForm->graduation_district_id = null;
        } else {
            if ($this->governmentForm->graduation_country_id != 1) {
                $this->governmentForm->graduation_state_id = null;
                $this->governmentForm->graduation_district_id = null;
            }
            $this->graduationStates = $this->governmentForm->graduation_country_id == 1 ? $this->states
                : new Collection();
        }
        $this->graduationDistrict = District::orderBy('name')
            ->where('state_id', $this->governmentForm->graduation_state_id)->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly('governmentForm.country_id');

        if ($propertyName == 'governmentForm.previous_residence_district_id') {
            $this->validateOnly('governmentForm.previous_residence_state_id');
        }

        if (in_array($propertyName,
            ['governmentForm.graduation_entrance_qualification_id', 'governmentForm.graduation_country_id',
                'governmentForm.is_vocational_training_completed', 'governmentForm.is_previous_another_university', ])
        ) {
            $this->validateOnly('governmentForm.enrollment_semester_id');
        }

        if (in_array($propertyName,
            [
                'governmentForm.last_exam_country_id',
                'governmentForm.last_exam_month',
                'governmentForm.last_exam_year',
            ])
        ) {
            $this->validateOnly('governmentForm.last_exam_id');
        }

        if ($propertyName == 'governmentForm.last_exam_id') {
            $this->validateOnly('governmentForm.last_study_type_id');
        }

        $this->validateOnly($propertyName);
        if (in_array($propertyName,
            ['governmentForm.previous_residence_country_id', 'governmentForm.previous_residence_state_id',
                'governmentForm.previous_residence_district_id', ])
        ) {
            $this->refreshPreviousResidenceCountryData($propertyName);
        }

        if (in_array($propertyName,
            ['governmentForm.current_residence_country_id', 'governmentForm.current_residence_state_id',
                'governmentForm.current_residence_district_id', ])
        ) {
            $this->refreshCurrentResidenceCountryData($propertyName);
        }

        if (in_array($propertyName, ['governmentForm.graduation_country_id', 'governmentForm.graduation_state_id',
            'governmentForm.graduation_district_id', ])
        ) {
            $this->refreshGraduationCountryData($propertyName);
        }

        $fieldName = explode('.', $propertyName)[1];

        if ($this->governmentForm->{$fieldName} == '') {
            $this->governmentForm->{$fieldName} = null;
        }

        $this->save($propertyName);
    }

    public function save($formProperty = null)
    {
        if ($formProperty) {
            $property = Str::afterLast($formProperty, '.');
            $this->governmentForm->update([$property => $this->governmentForm->{$property}]);
        } else {
            if ($this->applicant->government_form == null) {
                $this->applicant->government_form()->save($this->governmentForm);
            } else {
                $this->governmentForm->save();
            }
        }
    }

    public function submit()
    {
        $this->validate($this->rules());
        $this->governmentForm->is_submit = true;
        $this->governmentForm->user_id = $this->applicant->id;
        $this->governmentForm->save();
        $this->applicant->load(['government_form', 'study_sheet']);

        if ($this->applicant->government_form?->is_submit && $this->applicant->study_sheet?->is_submit) {
            Mail::to(config('mail.supporter.address'))->send(new GovernmentStudySheetSubmit($this->applicant));
            $this->applicant->application_status = ApplicationStatus::ENROLLMENT_ON;
            $this->applicant->save();
        }

        $this->toastNotify(__('Information saved successfully.'), __('Success'), TOAST_SUCCESS);
    }

    public function render()
    {
        return view('livewire.government-form');
    }
}
