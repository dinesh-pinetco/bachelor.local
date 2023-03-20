<?php

namespace App\Traits;

trait UpdateData
{
    public static function bootUpdateData(): void
    {
        self::created(function ($model) {
            $model->user->touch('last_data_updated_at');
        });

        self::updated(function ($model) {
            $model->user->touch('last_data_updated_at');
        });

        self::deleted(function ($model) {
            $model->user->touch('last_data_updated_at');
        });
    }
}
