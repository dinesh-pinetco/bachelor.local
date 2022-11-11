<?php

namespace Database\Seeders;

use App\Imports\StateImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new StateImport(), public_path('csv/1.1 States.csv'));
    }
}
