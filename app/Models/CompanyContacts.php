<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyContacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'contact_id',
        'first_name',
        'last_name'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
