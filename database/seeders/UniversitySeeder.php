<?php

namespace Database\Seeders;

use App\Imports\UniversityImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new UniversityImport(), public_path('csv/3 Universities.csv'));
    }
}
