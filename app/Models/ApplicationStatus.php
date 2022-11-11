<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $appends = ['translated_name'];

    public function translatedName(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            return __($attributes['name']);
        });
    }
}
