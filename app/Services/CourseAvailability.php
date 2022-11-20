<?php

namespace App\Services;

use App\Models\Course;
use App\Traits\Makeable;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class CourseAvailability
{
    use Makeable;

    protected Course $course;

    protected $year = null;

    protected array $desiredBeginnings = [];

    public function __construct(Course $course, $year = null)
    {
        $this->course = $course;
        $this->year = now()->year;
    }

    public function openingTime()
    {
        $startDate = $this->course->first_start;
        $lastDate = $this->course->last_start;
        if (! $lastDate) {
            $lastDate = Carbon::create(null, $this->course->last_start?->month)->addYears(MAX_YEAR);
        }

        $allSemesters = CarbonPeriod::create($startDate, '1 year', $lastDate);

        foreach ($allSemesters as $semester) {
            $openingDate = $semester->copy()->subDays($this->course->lead_time);
            $closingDate = $semester->copy()->subDays($this->course->dead_time);

            if ($openingDate->lte(today()) && $closingDate->gte(today())) {
                $this->desiredBeginnings[] = $semester;
            }
        }

        return $this->desiredBeginnings;
    }

    public function year($year)
    {
        $this->year = $year;

        return $this;
    }

    public function isAvailable()
    {
        $firstStartDate = Carbon::create($this->year, $this->course->first_start?->month);
        $leadTimeStarting = (clone $firstStartDate)->subDays($this->course->lead_time);

        return now()->isBetween($leadTimeStarting, $firstStartDate);
    }
}
