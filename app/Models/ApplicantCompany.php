<?php

namespace App\Models;

use App\Traits\UserDataUpdate;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantCompany extends Model
{
    use HasFactory, UserDataUpdate;

    protected $fillable = [
        'user_id',
        'company_id',
        'mail_content',
        'company_contacted_at',
        'company_rejected_at',
        'hired_at',
    ];

    protected $casts = [
        'company_contacted_at' => 'datetime',
        'hired_at' => 'datetime',
        'company_rejected_at' => 'datetime',
    ];

    protected function isRejected(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            return (bool) $attributes['company_rejected_at'];
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
