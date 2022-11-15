<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Option extends Model implements ContractsAuditable
{
    use AuditingAuditable, SoftDeletes;

    protected $fillable = ['field_id', 'key', 'value', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function values(): HasMany
    {
        return $this->hasMany(FieldValue::class);
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }
}
