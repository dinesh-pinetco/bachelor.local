<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'sanna_id',
        'name',
    ];

    public static function findFromSannaId(mixed $unternehmenId)
    {
        return self::where('sanna_id', $unternehmenId)->first();
    }

    public function contacts()
    {
        return $this->hasMany(CompanyContacts::class);
    }
}
