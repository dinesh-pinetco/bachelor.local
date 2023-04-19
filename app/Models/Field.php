<?php

namespace App\Models;

use App\Enums\FieldType;
use App\Filters\FieldFilters;
use App\Relations\HasManySyncable;
use App\Traits\Field\FieldRelations;
use App\Traits\HasManySync;
use App\Traits\SetLatestSortOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Field extends Model implements ContractsAuditable
{
    use AuditingAuditable, FieldRelations, SetLatestSortOrder, HasManySync;

    protected $fillable = ['tab_id', 'group_id', 'type', 'related_option_table', 'label', 'key', 'placeholder', 'sort_order', 'is_active', 'meta_data', 'validation'];

    protected $casts = [
        'meta_data' => 'array',
        'is_required' => 'bool',
        //        'is_active' => 'bool',
        'field_type' => FieldType::class,
    ];

    public function values(): HasManySyncable
    {
        return $this->hasMany(FieldValue::class);
    }

    public function value(): HasOne
    {
        return $this->hasOne(FieldValue::class);
    }

    public function tab(): BelongsTo
    {
        return $this->belongsTo(Tab::class);
    }

    public function scopeFilter($query)
    {
        return resolve(FieldFilters::class)->apply($query);
    }

    public function scopeRequired($query)
    {
        return $query->where('is_required', true);
    }

    public function scopeActivate($query)
    {
        return $query->where('is_active', true);
    }

    public function required(): bool
    {
        return $this->is_required;
    }
}
