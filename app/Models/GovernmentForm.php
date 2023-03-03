<?php

namespace App\Models;

use App\Traits\GovernmentFormRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class GovernmentForm extends Model implements ContractsAuditable
{
    use AuditingAuditable, GovernmentFormRelations, HasFactory;

    protected $guarded = [];

    protected array $auditInclude = [
        'value',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
