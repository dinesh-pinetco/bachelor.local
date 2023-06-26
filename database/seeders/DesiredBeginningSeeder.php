<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DesiredBeginningSeeder extends Seeder
{
    public function run()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $showNextYear = false;

        if ($currentMonth >= 6 || $currentMonth < 1) {
            // Current year and next year
            $showNextYear = true;
            $year = now()->addYear()->format('Y');
        } else {
            $year = now()->format('Y');
        }

        \App\Models\DesiredBeginning::create([
            'course_start_date' => Carbon::createFromDate($year, COURSE_STARTING_MONTH, 1),
        ]);
    }
}
