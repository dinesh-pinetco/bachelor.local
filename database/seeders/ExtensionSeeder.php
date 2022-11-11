<?php

namespace Database\Seeders;

use App\Models\Extension;
use Illuminate\Database\Seeder;

class ExtensionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Extension::insert([
            ['name' => 'Pdf', 'extension' => '.pdf'],
            ['name' => 'Docx', 'extension' => '.docx'],
            ['name' => 'Doc', 'extension' => '.doc'],
            ['name' => 'Png', 'extension' => '.png'],
            ['name' => 'Jpg', 'extension' => '.jpg'],
            ['name' => 'Jpeg', 'extension' => '.jpeg'],
        ]);
    }
}
