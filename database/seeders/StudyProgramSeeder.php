<?php

namespace Database\Seeders;

use App\Imports\StudyProgramImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new StudyProgramImport(), public_path('csv/4.1 StudyPrograms.csv'));
    }
}
