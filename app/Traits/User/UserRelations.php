<?php

namespace App\Traits\User;

use App\Models\ApplicantCompany;
use App\Models\DesiredBeginning;
use App\Models\FieldValue;
use App\Models\GovernmentForm;
use App\Models\Meteor;
use App\Models\ModelHasCourse;
use App\Models\Moodle;
use App\Models\Result;
use App\Models\StudySheet;
use App\Models\UserConfiguration;
use App\Models\UserHubspotConfiguration;
use App\Models\UserPreference;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait UserRelations
{
    public function values(): HasMany
    {
        return $this->hasMany(FieldValue::class);
    }

    public function moodle(): HasOne
    {
        return $this->hasOne(Moodle::class);
    }

    public function meteor(): HasOne
    {
        return $this->hasOne(Meteor::class);
    }

    public function preference(): HasOne
    {
        return $this->hasOne(UserPreference::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function hubspotConfiguration()
    {
        return $this->hasOne(UserHubspotConfiguration::class);
    }

    public function desiredBeginning()
    {
        return $this->hasOne(DesiredBeginning::class)
            ->latest();
    }

    public function courses()
    {
        return $this->hasManyThrough(
            ModelHasCourse::class,
            DesiredBeginning::class,
            'user_id',
            'model_id',
            'id',
            'id'
        )->where('model_type', DesiredBeginning::class);
    }

    public function configuration(): HasOne
    {
        return $this->hasOne(UserConfiguration::class);
    }

    public function companies()
    {
        return $this->hasMany(ApplicantCompany::class);
    }

    public function study_sheet(): HasOne
    {
        return $this->hasOne(StudySheet::class);
    }

    public function government_form(): HasOne
    {
        return $this->hasOne(GovernmentForm::class);
    }
}
