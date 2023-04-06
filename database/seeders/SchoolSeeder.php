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
        Excel::import(new SchoolImport(), public_path('csv/Bremen_Schulen_fuer_BA-Bewerberportal_2023-04-04.xlsx'));
        Excel::import(new SchoolImport(), public_path('csv/MV_Schulen_fuer_BA-Bewerberportal_2023-04-04.xlsx'));
        Excel::import(new SchoolImport(), public_path('csv/Niedersachsen_Schulen_fuer_BA-Bewerberportal_2023-04-04.xlsx'));
        Excel::import(new SchoolImport(), public_path('csv/SH_HH_Schulen_fuer_BA-Bewerberportal_2023-04-04.xlsx'));
    }
}
