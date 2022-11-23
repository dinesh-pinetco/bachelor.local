<?php

namespace App\Models;

use App\Traits\HasCourses;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DesiredBeginning extends Model
{
    use HasCourses;

    protected $dates = ['course_start_date'];

    protected $guarded = [];

    public static function options($onlyFuture = false): array
    {
        $desiredBeginnings = [];
        if (now()->month > COURSE_STARTING_MONTH) {
            $nextCourseStarting = Carbon::parse()->addYear()->startOfMonth()->month(COURSE_STARTING_MONTH);
        } else {
            $nextCourseStarting = Carbon::parse()->startOfMonth()->month(COURSE_STARTING_MONTH);
        }

        $collection = CarbonPeriod::create(
            $nextCourseStarting,
            '1 year',
            $nextCourseStarting->copy()->addYears(FUTURE_YEAR));

        foreach ($collection as $courseDate) {
            $desiredBeginnings[] = ['key' => $courseDate->format('Y-m-d'), 'title' => $courseDate->format('F Y')];
        }

        return $desiredBeginnings;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
