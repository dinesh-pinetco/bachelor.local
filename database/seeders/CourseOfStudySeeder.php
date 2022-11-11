<?php

namespace Database\Seeders;

use App\Imports\CourseOfStudyImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class CourseOfStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new CourseOfStudyImport(), public_path('csv/CoursesOfStudy.csv'));
    }
}
