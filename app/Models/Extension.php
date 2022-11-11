<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Extension extends Model implements ContractsAuditable
{
    use AuditingAuditable;

    protected $fillable = ['name'];
}
