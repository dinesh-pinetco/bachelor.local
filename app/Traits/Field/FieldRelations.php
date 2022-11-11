<?php

namespace App\Traits\Field;

use App\Models\FieldValue;
use App\Models\Group;
use App\Models\Option;
use App\Models\Tab;
use App\Relations\HasManySyncable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait FieldRelations
{
    public function tab(): BelongsTo
    {
        return $this->belongsTo(Tab::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function options(): HasManySyncable
    {
        return $this->hasMany(Option::class)->select(['id', 'field_id', 'key', 'value']);
    }

    public function values(): HasManySyncable
    {
        return $this->hasMany(FieldValue::class);
    }
}
