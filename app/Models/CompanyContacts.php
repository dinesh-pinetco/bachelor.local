<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyContacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'sana_id',
        'first_name',
        'last_name',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected function fullName(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            return collect([$attributes['first_name'], $attributes['last_name']])->filter()->implode(' ');
        });
    }

    public static function findFromSannaId(mixed $sannaId)
    {
        return self::where('sana_id', $sannaId)->first();
    }
}
