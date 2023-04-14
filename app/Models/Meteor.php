<?php

namespace App\Models;

use App\Traits\UserDataUpdate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Meteor extends Model implements ContractsAuditable
{
    use AuditingAuditable, UserDataUpdate;

    protected $guarded = [];

    public static function generate_na_tan(): string
    {
        return sprintf('%s-%s', config('application.prefix_na_tan'), Str::random(10));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
