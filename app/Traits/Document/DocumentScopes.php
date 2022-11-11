<?php

namespace App\Traits\Document;

use App\Filters\DocumentFilters;

trait DocumentScopes
{
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeRequired($query)
    {
        return $query->where('is_required', true);
    }

    public function scopeSearchByKey($query, $key, $keyword)
    {
        if ($key && $keyword) {
            return $query->where($key, 'like', "%$keyword%");
        }
    }

    public function scopeFilter($query)
    {
        return resolve(DocumentFilters::class)->apply($query);
    }
}
