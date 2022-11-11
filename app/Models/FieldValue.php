<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class FieldValue extends Model implements ContractsAuditable
{
    use AuditingAuditable, SoftDeletes;

    protected $fillable = ['user_id', 'field_id', 'option_id', 'value', 'group_key'];

    protected array $auditInclude = [
        'value',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class);
    }

    public function fields(): BelongsTo
    {
        return $this->belongsTo(Field::class, 'field_id', 'id');
    }

    public function scopeSearchByField($query, $fieldKey)
    {
        if ($fieldKey) {
            return $query->whereRelation('fields', 'key', $fieldKey);
        }
    }
}
