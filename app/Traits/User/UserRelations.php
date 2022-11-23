<?php

namespace App\Traits\User;

use App\Models\DesiredBeginning;
use App\Models\FieldValue;
use App\Models\Meteor;
use App\Models\Moodle;
use App\Models\Result;
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
}
