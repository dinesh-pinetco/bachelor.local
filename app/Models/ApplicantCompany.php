<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ApplicantCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'mail_content',
        'company_contacted_at',
        'hired_at',
    ];

    protected $casts = ['company_contacted_at' => 'datetime', 'hired_at' => 'datetime'];

    public static function boot()
    {
        parent::boot();

        self::created(function ($model){
            $model->user->touch('last_data_updated_at');
        });

        self::updated(function ($model){
            $model->user->touch('last_data_updated_at');
        });

        self::deleted(function ($model){
            $model->user->touch('last_data_updated_at');
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
