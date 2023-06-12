<?php

namespace App\Models;

use App\Filters\DesiredBeginningFilters;
use App\Traits\HasCourses;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
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
        $desiredBeginnings = [];
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $showNextYear = false;
        $nextCourseStarting = Carbon::create($currentYear, COURSE_STARTING_MONTH, 1);

        if ($currentMonth >= 6 || $currentMonth < 1) {
            // Current year and next year
            $showNextYear = true;
        }

        $endDate = $showNextYear ? Carbon::create($currentYear + 1, 12, 31) : Carbon::create($currentYear, 12, 31);

        $collection = CarbonPeriod::create($nextCourseStarting, '1 year', $endDate);

        foreach ($collection as $courseDate) {
            if ($showNextYear || $courseDate->year === $currentYear) {
                $desiredBeginnings[] = [
                    'key' => $courseDate->format('Y-m-d'),
                    'title' => $courseDate->translatedFormat(self::TITLE),
                ];
            }
        }

        return $desiredBeginnings;
    }

    public function courses()
    {
        return $this->morphToMany(Course::class, 'model', 'model_has_courses', 'model_id', 'course_id');
    }
}
