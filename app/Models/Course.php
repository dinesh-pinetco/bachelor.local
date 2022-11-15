<?php

namespace App\Models;

use App\Filters\CourseFilters;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Course extends Model implements ContractsAuditable
{
    use AuditingAuditable, SoftDeletes;

    const SEARCHABLE_FIELDS = ['name', 'description', 'form_of_study', 'first_start', 'last_start'];

    protected $fillable = ['sana_id', 'name', 'description', 'form_of_study', 'first_start', 'last_start', 'is_active', 'lead_time', 'dead_time', 'sort_order'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->sort_order = self::max('sort_order') + 1;
        });
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function desired_beginnings(): BelongsToMany
    {
        return $this->belongsToMany(DesiredBeginning::class)->orderBy('month');
    }

    public function statistics(): HasMany
    {
        return $this->hasMany(Statistics::class);
    }

    protected function isActiveLabel(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            return $attributes['is_active'] ? __('Active') : __('InActive');
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFilter($query)
    {
        return resolve(CourseFilters::class)->apply($query);
    }

    public function scopeSearchByKey($query, $key, $keyword)
    {
        if ($key && $keyword) {
            return $query->where($key, 'like', "%$keyword%");
        }
    }
}
