<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'mail_content',
        'is_contact_by_company',
        'hired_at',
    ];

    protected $casts = ['is_contact_by_company' => 'bool', 'hired_at' => 'datetime'];

    public function applicant()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
