<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseOfStudy extends Model
{
    protected $fillable = ['sana_id', 'short_form', 'name', 'name_en', 'title', 'title_short', 'study_program_id'];
}
