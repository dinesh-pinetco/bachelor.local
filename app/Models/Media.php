<?php

namespace App\Models;

use App\Traits\Media\MediaHelpers;
use App\Traits\UserDataUpdate;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

class Media extends Model implements ContractsAuditable
{
    use AuditingAuditable, MediaHelpers, UserDataUpdate;

    public const TAG_CURRICULUM_VITAE = 'curriculum_vitae';

    public const TAG_TESTIMONIES = 'testimonies';

    public $incrementing = false;

    // protected $keyType = 'string';

    protected $fillable = [
        'name', 'extension', 'mime_type', 'size', 'path', 'tag', 'is_check',
    ];

    protected $hidden = [
        'user_id', 'mediable_id', 'mediable_type',
    ];

    protected $casts = [
        'is_check' => 'boolean',
    ];

    protected array $auditInclude = [
        'name', 'extension',
    ];

    protected $directory;

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeHasTag($query, $tag)
    {
        return $query->where('tag', $tag);
    }

    protected function url(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            return Storage::url($attributes['path']);
        });
    }
}
