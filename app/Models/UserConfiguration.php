<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserConfiguration extends Model
{
    use HasFactory;

    protected $guarded = [];

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
