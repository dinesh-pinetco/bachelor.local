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

    const TITLE = 'F Y';

    protected $casts = ['course_start_date' => 'date'];

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
