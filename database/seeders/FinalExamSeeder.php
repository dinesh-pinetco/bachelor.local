<?php

namespace Database\Seeders;

use App\Imports\FinalExamImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class FinalExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new FinalExamImport(), public_path('csv/5 FinalExams.csv'));
    }
}
