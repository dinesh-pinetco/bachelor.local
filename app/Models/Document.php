<?php

namespace App\Models;

use App\Traits\Document\DocumentScopes;
use App\Traits\HasCourses;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Document extends Model implements ContractsAuditable
{
    use AuditingAuditable, HasCourses, DocumentScopes;

    const SEARCHABLE_FIELDS = ['name', 'description'];

    protected $fillable = ['creator_id', 'name', 'description', 'is_required', 'is_active'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function medias(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function extensions(): BelongsToMany
    {
        return $this->belongsToMany(Extension::class);
    }

    protected function isActiveLabel(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            return $attributes['is_active'] ? __('Active') : __('InActive');
        });
    }

    protected function isRequiredLabel(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            return $attributes['is_required'] ? __('Required') : __('Optional');
        });
    }
}
