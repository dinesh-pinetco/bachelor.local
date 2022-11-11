<?php

namespace App\Models;

use App\Traits\SetLatestSortOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Tab extends Model implements ContractsAuditable
{
    use AuditingAuditable, SoftDeletes, SetLatestSortOrder;

    protected $fillable = ['internal_name', 'name', 'description', 'slug', 'icon', 'sort_order', 'meta_data'];

    protected $casts = [
        'meta_data' => 'array',
    ];

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class)->orderBy('sort_order');
    }

    public function parent_groups(): HasMany
    {
        return $this->hasMany(Group::class)->whereNull('parent_id')->orderBy('sort_order');
    }

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class)->orderBy('sort_order');
    }

    public function scopeActiveFields($query, $user_id = null)
    {
        return $query
            ->with([
                'parent_groups',
                'parent_groups.child',
                'parent_groups.child.fields'        => function ($query) {
                    $query->where('is_active', 1);
                },
                'parent_groups.child.fields.values' => function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                },
                'parent_groups.fields'              => function ($query) {
                    $query->where('is_active', 1);
                },
                'parent_groups.fields.values'       => function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                },
            ])
            ->where(function ($qry) {
                $qry->whereHas('parent_groups.fields', function ($query) {
                    $query->where('is_active', 1);
                })->orWhereHas('parent_groups.child.fields', function ($query) {
                    $query->where('is_active', 1);
                });
            });
    }
}
