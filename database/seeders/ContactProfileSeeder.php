<?php

namespace Database\Seeders;

use App\Models\ContactProfile;
use App\Models\Course;
use Illuminate\Database\Seeder;

class ContactProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContactProfile::create([
            'name' => 'NORDAKADEMIE Campus Elmshorn',
            'email' => 'auswahltest@nordakademie.de',
            'phone' => '+49412140900',
        ])->attachCourses(Course::pluck('id')->toArray());
    }
}
