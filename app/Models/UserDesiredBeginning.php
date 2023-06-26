<?php

namespace App\Models;

use App\Traits\HasCourses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDesiredBeginning extends Model
{
    use HasFactory;
    use HasCourses;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function desiredBeginning(): BelongsTo
    {
        return $this->belongsTo(DesiredBeginning::class);
    }

    public function courses()
    {
        return $this->morphToMany(Course::class, 'model', 'model_has_courses', 'model_id', 'course_id')->withTimestamps();
    }
}
