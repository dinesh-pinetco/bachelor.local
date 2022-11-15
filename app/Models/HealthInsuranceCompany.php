<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthInsuranceCompany extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
