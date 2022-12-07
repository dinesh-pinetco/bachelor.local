<?php

namespace App\Models;

use App\Filters\GroupFilters;
use App\Traits\SetLatestSortOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Group extends Model implements ContractsAuditable
{
    use AuditingAuditable, SoftDeletes, SetLatestSortOrder;

    protected $fillable = ['tab_id', 'parent_id', 'internal_name', 'title', 'description', 'can_add_more', 'add_more_label', 'sort_order'];

    protected $casts = [
        'can_add_more' => 'boolean',
    ];

    public function tab(): BelongsTo
    {
        return $this->belongsTo(Tab::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(static::class, 'parent_id');
    }

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class)->orderBy('sort_order');
    }

    public function child(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->orderBy('sort_order');
    }

    public function scopeFilter($query)
    {
        return resolve(GroupFilters::class)->apply($query);
    }
}
