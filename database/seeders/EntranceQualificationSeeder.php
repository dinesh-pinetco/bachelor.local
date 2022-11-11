<?php

namespace Database\Seeders;

use App\Imports\EntranceQualificationImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class EntranceQualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new EntranceQualificationImport(), public_path('csv/8 EntranceQualification.csv'));
    }
}
