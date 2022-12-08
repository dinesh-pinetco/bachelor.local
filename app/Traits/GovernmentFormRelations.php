<?php

namespace App\Traits;

use App\Models\District;
use App\Models\EntranceQualification;
use App\Models\FinalExam;
use App\Models\Nationality;
use App\Models\State;
use App\Models\StudyProgram;
use App\Models\StudyType;
use App\Models\University;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait GovernmentFormRelations
{
    public function country(): BelongsTo
    {
        return $this->belongsTo(Nationality::class, 'country_id', 'id');
    }

    public function second_country(): BelongsTo
    {
        return $this->belongsTo(Nationality::class, 'second_country_id', 'id');
    }

    public function previous_residence_country(): BelongsTo
    {
        return $this->belongsTo(Nationality::class, 'previous_residence_country_id', 'id');
    }

    public function previous_residence_state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'previous_residence_state_id', 'id');
    }

    public function previous_residence_district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'previous_residence_district_id', 'id');
    }

    public function current_residence_country(): BelongsTo
    {
        return $this->belongsTo(Nationality::class, 'current_residence_country_id', 'id');
    }

    public function current_residence_state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'current_residence_state_id', 'id');
    }

    public function current_residence_district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'current_residence_district_id', 'id');
    }

    public function enrollment_university(): BelongsTo
    {
        return $this->belongsTo(University::class, 'enrollment_university_id', 'id');
    }

    public function enrollment_country(): BelongsTo
    {
        return $this->belongsTo(Nationality::class, 'enrollment_country_id', 'id');
    }

    public function graduation_entrance_qualification(): BelongsTo
    {
        return $this->belongsTo(EntranceQualification::class, 'graduation_entrance_qualification_id', 'id');
    }

    public function graduation_country(): BelongsTo
    {
        return $this->belongsTo(Nationality::class, 'graduation_country_id', 'id');
    }

    public function graduation_state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'graduation_state_id', 'id');
    }

    public function graduation_district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'graduation_district_id', 'id');
    }

    public function previous_college(): BelongsTo
    {
        return $this->belongsTo(University::class, 'previous_college_id', 'id');
    }

    public function previous_college_country(): BelongsTo
    {
        return $this->belongsTo(Nationality::class, 'previous_college_country_id', 'id');
    }

    public function previous_study_type(): BelongsTo
    {
        return $this->belongsTo(StudyType::class, 'previous_study_type_id', 'id');
    }

    public function previous_final_exam(): BelongsTo
    {
        return $this->belongsTo(FinalExam::class, 'previous_final_exam_id', 'id');
    }

    public function previous_course(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'previous_course_id', 'id');
    }

    public function previous_second_course(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'previous_second_course_id', 'id');
    }

    public function previous_third_course(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'previous_third_course_id', 'id');
    }

    public function last_exam_university(): BelongsTo
    {
        return $this->belongsTo(University::class, 'last_exam_university_id', 'id');
    }

    public function last_exam_country(): BelongsTo
    {
        return $this->belongsTo(Nationality::class, 'last_exam_country_id', 'id');
    }

    public function last_exam(): BelongsTo
    {
        return $this->belongsTo(FinalExam::class, 'last_exam_id', 'id');
    }

    public function last_study_type(): BelongsTo
    {
        return $this->belongsTo(StudyType::class, 'last_study_type_id', 'id');
    }

    public function last_exam_course(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'last_exam_course_id', 'id');
    }

    public function last_exam_second_course(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'last_exam_second_course_id', 'id');
    }

    public function last_exam_third_course(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'last_exam_third_course_id', 'id');
    }
}
