<?php

namespace App\Models;

use App\Filters\ContactProfileFilters;
use App\Traits\HasCourses;
use Illuminate\Database\Eloquent\Model;
use Laravel\Jetstream\HasProfilePhoto;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class ContactProfile extends Model implements ContractsAuditable
{
    use AuditingAuditable, HasProfilePhoto, HasCourses;

    protected array $auditInclude = [
        'name', 'email', 'phone',
    ];

    public function scopeFilter($query)
    {
        return resolve(ContactProfileFilters::class)->apply($query);
    }
}
