<?php

namespace App\Traits;

use App\Models\ApplicationStatus;
use App\Models\Course;
use App\Models\DesiredBeginning;
use App\Models\District;
use App\Models\Document;
use App\Models\EntranceQualification;
use App\Models\Extension;
use App\Models\Field;
use App\Models\FinalExam;
use App\Models\Group;
use App\Models\HealthInsuranceCompany;
use App\Models\Nationality;
use App\Models\Option;
use App\Models\State;
use App\Models\StudyProgram;
use App\Models\StudyType;
use App\Models\Tab;
use App\Models\Test;
use App\Models\University;
use App\Models\User;

trait AuditableGetValue
{
    private function user($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = User::whereIn('id', $value)->get();
    }

    private function applicationStatus($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = ApplicationStatus::whereIn('id', $value)->get();
    }

    private function course($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = Course::whereIn('id', $value)->get();
    }

    private function desiredBeginning($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = DesiredBeginning::whereIn('id', $value)->get();
    }

    private function tab($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = Tab::whereIn('id', $value)->get();
    }

    private function group($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = Group::whereIn('id', $value)->get();
    }

    private function field($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = Field::whereIn('id', $value)->get();
    }

    private function option($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = Option::whereIn('id', $value)->get();
    }

    private function test($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = Test::whereIn('id', $value)->get();
    }

    private function document($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = Document::whereIn('id', $value)->get();
    }

    private function extension($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = Extension::whereIn('id', $value)->get();
    }

    private function studyProgram($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = StudyProgram::whereIn('id', $value)->get();
    }

    private function healthInsuranceCompany($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = HealthInsuranceCompany::whereIn('id', $value)->get();
    }

    private function nationality($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = Nationality::whereIn('id', $value)->get();
    }

    private function state($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = State::whereIn('id', $value)->get();
    }

    private function district($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = District::whereIn('id', $value)->get();
    }

    private function university($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = University::whereIn('id', $value)->get();
    }

    private function entranceQualification($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = EntranceQualification::whereIn('id', $value)->get();
    }

    private function studyType($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = StudyType::whereIn('id', $value)->get();
    }

    private function finalExam($key, array $value)
    {
        $this->foreignKeyCollection->{$key} = FinalExam::whereIn('id', $value)->get();
    }
}
