<?php

namespace App\Models;

use App\Filters\DesiredBeginningFilters;
use App\Traits\HasCourses;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class DesiredBeginning extends Model
{
    use HasCourses;

    protected $dates = ['course_start_date'];

    protected $guarded = [];

    const TITLE = 'F Y';

    const SEARCHABLE_FIELDS = ['course_start_date'];

    protected $casts = ['course_start_date' => 'date'];

    protected function isActiveLabel(): Attribute
    {
        return Attribute::get(function ($value, $attributes) {
            return is_null($attributes['archived_at']) ? __('Active') : __('InActive');
        });
    }

    public function scopeSearchByKey($query, $key, $keyword)
    {
        if ($key && $keyword) {
            return $query->where($key, 'like', "%$keyword%");
        }
    }

    public function scopeFilter($query)
    {
        return resolve(DesiredBeginningFilters::class)->apply($query);
    }

    public function scopeActive($query)
    {
        return $query->whereNull('archived_at');
    }

    public static function options(): array
    {
        $collection = self::all();
        $desiredBeginnings = [];

        foreach ($collection as $desiredBeginning) {
            $desiredBeginnings[] = [
                'id' => $desiredBeginning->id,
                'key' => $desiredBeginning->course_start_date->format('Y-m-d'),
                'title' => $desiredBeginning->course_start_date->translatedFormat(self::TITLE),
            ];
        }

        return $desiredBeginnings;
    }

    public function courses()
    {
        return $this->morphToMany(Course::class, 'model', 'model_has_courses', 'model_id', 'course_id');
    }
}
