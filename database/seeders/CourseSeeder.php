<?php

namespace Database\Seeders;

use App\Imports\CourseImport;
use App\Models\DesiredBeginning;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $desiredBeginning = DesiredBeginning::pluck('id');
        Excel::import(new CourseImport($desiredBeginning), public_path('csv/Courses.csv'));
    }
}
