<?php

namespace App\Models;

use App\Filters\AuditFilters;
use App\Traits\AuditScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OwenIt\Auditing\Models\Audit as ModelsAudit;

class Audit extends ModelsAudit
{
    use HasFactory, AuditScope;

    const SEARCHABLE_FIELDS = ['owner', 'user'];

    public function owner(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeFilter($query)
    {
        return resolve(AuditFilters::class)->apply($query);
    }
}
