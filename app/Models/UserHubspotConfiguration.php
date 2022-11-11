<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHubspotConfiguration extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = ['user_updated_at', 'last_hubspot_contact_updated_at'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->user_updated_at = now();
        });
    }

    public function updateLastHubspotContactUpdatedAt()
    {
        $this->update(['last_hubspot_contact_updated_at' => now()]);
    }

    public function updateUserUpdatedAt()
    {
        $this->update(['user_updated_at' => now()]);
    }
}
