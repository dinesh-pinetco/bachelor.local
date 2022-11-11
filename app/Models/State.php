<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    protected $fillable = ['sana_id', 'state_id', 'name'];

    public function districts(): HasMany
    {
        return $this->hasMany(District::class, 'state_id', 'sana_id');
    }
}
