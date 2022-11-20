<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class ModelHasCourse extends Model implements ContractsAuditable
{
    use AuditingAuditable;

    protected $dates = ['course_start_date'];

    protected $casts = [
        'course_start_date' => 'datetime',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
