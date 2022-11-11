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
            'name'  => 'Nordakademie Team',
            'email' => 'auswahltest@nordakademie.de',
            'phone' => '+49 (0)40 554387-300',
        ])->attachCourses(Course::pluck('id')->toArray());
    }
}
