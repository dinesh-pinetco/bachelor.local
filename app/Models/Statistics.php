<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistics extends Model
{
    protected $guarded = [];

    protected $casts = [
        'desired_beginning_date' => 'date',
    ];
}
