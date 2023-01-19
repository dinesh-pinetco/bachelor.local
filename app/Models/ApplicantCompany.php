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
        'company_name',
        'mail_content',
    ];

    public function applicant()
    {
        return $this->hasOne(User::class);
    }
}
