<?php

namespace Database\Seeders;

use App\Imports\SchoolImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new SchoolImport(), public_path('csv/schule.csv'));
    }
}
