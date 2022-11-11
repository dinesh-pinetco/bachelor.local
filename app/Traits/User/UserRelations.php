<?php

namespace App\Traits\User;

use App\Models\ApplicationStatus;
use App\Models\Contract;
use App\Models\FieldValue;
use App\Models\GovernmentForm;
use App\Models\Interview;
use App\Models\Meteor;
use App\Models\Moodle;
use App\Models\Result;
use App\Models\StudySheet;
use App\Models\UserHubspotConfiguration;
use App\Models\UserPreference;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function interview(): HasOne
    {
        return $this->hasOne(Interview::class);
    }

    public function application_status(): BelongsTo
    {
        return $this->belongsTo(ApplicationStatus::class);
    }

    public function contract(): HasOne
    {
        return $this->hasOne(Contract::class);
    }

    public function study_sheet(): HasOne
    {
        return $this->hasOne(StudySheet::class);
    }

    public function government_form(): HasOne
    {
        return $this->hasOne(GovernmentForm::class);
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
}
