<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait Mediable
{
    public static function bootMediable(): void
    {
        static::deleting(function ($model) {
            $model->removeMedia();
        });
    }

    public function removeMedia(): void
    {
        $this->media->each->delete();
    }

    public function media(): HasMany
    {
        return $this->hasMany(Media::class);
    }

    public function media_private_document(): HasMany
    {
        return $this->hasMany(Media::class)->where('tag', 'private_document');
    }

    public function attachMedia(array $ids = [])
    {
        return Media::whereIn('id', $ids)->update([
            'mediable_type' => get_class($this),
            'mediable_id' => $this->id,
        ]);
    }
}
