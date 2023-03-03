<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserConfiguration extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'competency_catch_up' => 'bool',
        'pass_pdf_created_at' => 'datetime',
        'fail_pdf_created_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function selectionTestPassedPdf(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            return $attributes['selection_test_result_passed_pdf_path'] ? \Storage::url($attributes['selection_test_result_passed_pdf_path']) : null;
        });
    }

    public function selectionTestFailedPdf(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            return $attributes['selection_test_result_failed_pdf_path'] ? \Storage::url($attributes['selection_test_result_failed_pdf_path']) : null;
        });
    }
}
