<?php

namespace App\Models;

use App\Traits\UpdateData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantCompany extends Model
{
    use HasFactory, UpdateData;

    protected $fillable = [
        'user_id',
        'company_id',
        'mail_content',
        'company_contacted_at',
        'hired_at',
    ];

    protected $casts = ['company_contacted_at' => 'datetime', 'hired_at' => 'datetime'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
