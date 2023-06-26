<?php

namespace App\Models;

use App\Traits\UserDataUpdate;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicantCompany extends Model
{
    use HasFactory, UserDataUpdate;

    protected $fillable = [
        'user_id',
        'company_id',
        'company_contacted_at',
        'company_rejected_at',
        'company_hired_at',
        'company_contact_id',
        'is_see_test_results',
    ];

    protected $casts = [
        'company_contacted_at' => 'datetime',
        'company_hired_at' => 'datetime',
        'company_rejected_at' => 'datetime',
        'is_see_test_results' => 'bool',
    ];

    protected function isRejected(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            return (bool) $attributes['company_rejected_at'];
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function companyContact()
    {
        return $this->belongsTo(CompanyContacts::class);
    }
}
