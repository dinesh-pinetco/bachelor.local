<?php

namespace App\Models;

use App\Filters\FaqFilters;
use App\Traits\HasCourses;
use App\Traits\SetLatestSortOrder;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Faq extends Model implements ContractsAuditable
{
    use AuditingAuditable, HasCourses, SetLatestSortOrder;

    protected $fillable = ['name', 'question', 'answer', 'sort_order'];

    protected array $auditInclude = [
        'name', 'question', 'answer',
    ];

    public function scopeFilter($query)
    {
        return resolve(FaqFilters::class)->apply($query);
    }
}
