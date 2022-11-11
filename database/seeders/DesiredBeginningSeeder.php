<?php

namespace Database\Seeders;

use App\Models\DesiredBeginning;
use Illuminate\Database\Seeder;

class DesiredBeginningSeeder extends Seeder
{
    public function run()
    {
        DesiredBeginning::create([
            'name' => '1. Oktober',
            'day' => 1,
            'month' => 10,
        ]);
    }
}
