<?php

namespace App\Traits;

trait SetLatestSortOrder
{
    protected static function boot(): void
    {
        parent::boot();
        self::creating(function ($model) {
            $maxSortOrder = self::max('sort_order');

            if (in_array(class_basename(self::class), ['Filed', 'Group'])) {
                $maxSortOrder = self::where('tab_id', $model->tab_id)->max('sort_order');
            }

            $model->sort_order = $maxSortOrder + 1;
        });
    }
}
