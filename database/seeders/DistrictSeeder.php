<?php

namespace Database\Seeders;

use App\Imports\DistrictImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new DistrictImport(), public_path('csv/1.2 Districts.csv'));
    }
}
