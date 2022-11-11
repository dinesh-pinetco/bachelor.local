<?php

namespace Database\Seeders;

use App\Imports\NationalityImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new NationalityImport(), public_path('csv/6.1 Nationalities.csv'));
    }
}
