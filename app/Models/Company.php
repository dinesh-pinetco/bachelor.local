<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'sana_id',
        'name',
        'zip_code',
        'meta',
    ];

    public static function findFromSannaId(mixed $sannaId)
    {
        return self::where('sana_id', $sannaId)->first();
    }

    public function scopeSearchByName($query, $search)
    {
        return $query->where('name', 'like', '%'.$search.'%');
    }

    public function contacts()
    {
        return $this->hasMany(CompanyContacts::class);
    }

    public static function catchCollection()
    {
        Cache::put('fetchSannaCompanies', Company::orderBy('name')->get());
    }

    public static function getFromCache()
    {
        return Cache::get('fetchSannaCompanies', []);
    }
}
