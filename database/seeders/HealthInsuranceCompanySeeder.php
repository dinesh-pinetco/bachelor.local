<?php

namespace Database\Seeders;

use App\Imports\HealthInsuranceCompanyImport;
use App\Models\HealthInsuranceCompany;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class HealthInsuranceCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HealthInsuranceCompany::create([
            'short_description' => 'Andere Krankenkasse',
            'name1'             => '',
            'name2'             => '',
            'name3'             => '',
            'company_number'    => '',
        ]);
        Excel::import(new HealthInsuranceCompanyImport(), public_path('csv/gkv_krankenkassen.csv'));
    }
}
