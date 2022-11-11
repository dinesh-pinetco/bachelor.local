<?php

namespace App\Services;

use App\Models\Course;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;

class DesiredBeginningFilter
{
    private Course $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function filter($oldDesiredBeginnings = false): Collection
    {
        $allDesiredBeginnings = new Collection();
        $latestDesiredBeginning = $this->course->desired_beginnings->sortBy('month', SORT_NATURAL, true);
        $lastDate = $this->course->last_start;
        if (! $lastDate) {
            $lastRaw = $latestDesiredBeginning->first();
            $lastDate = Carbon::create(null, $lastRaw->month, $lastRaw->day)->addYear(MAX_YEAR);
        }

        $this->course->desired_beginnings->each(function ($desiredBeginning) use (
            $oldDesiredBeginnings,
            $allDesiredBeginnings,
            $lastDate
        ) {
            $year = $oldDesiredBeginnings ? Carbon::create($this->course->first_start)->year : null;
            $startDate = Carbon::create($year, $desiredBeginning->month,
                $desiredBeginning->day);
            $allSemesters = CarbonPeriod::create($startDate, '1 year', $lastDate);
            foreach ($allSemesters as $semester) {
                $openingDate = $semester->copy()->subDays($this->course->lead_time);
                $closingDate = $semester->copy()->subDays($this->course->dead_time);
                if ($oldDesiredBeginnings
                    || (! $semester->isPast() && $openingDate->lte(today())
                        && $closingDate->gte(today()))
                ) {
                    $desiredBeginning = clone $desiredBeginning;
                    $desiredBeginning->date = $semester;
                    $desiredBeginning->unix_time = $semester->unix();
                    $allDesiredBeginnings->push($desiredBeginning);
                }
            }
        });

        return $allDesiredBeginnings->sortBy('unix_time')->values();
    }
}
