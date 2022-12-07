<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Test;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Test::create([
            'name' => 'Moodle',
            'type' => Test::TYPE_MOODLE,
            'description' => 'Entrance Examination is the mode for getting admission into various undergraduate, post graduate and professional degree courses. Basically entrance examination is common at higher level of education which is conducted by educational institutes and colleges.',
            'duration' => '60.00',
            'is_required' => true,
            'is_active' => true,
            'link' => 'https://auswahltest.nordakademie.de/moodle/webservice/rest/server.php',
            'has_passing_limit' => true,
            'passing_limit' => 50,
        ])->attachCourses(Course::pluck('id')->toArray());

        Test::create([
            'name' => 'Cubia',
            'type' => Test::TYPE_CUBIA,
            'description' => 'A final examination, annual, exam, final interview, or simply final, is a test given to students at the end of a course of study or training. Although the term can be used in the context of physical training, it most often occurs in the academic world.',
            'duration' => '60.00',
            'is_required' => true,
            'is_active' => true,
            'link' => 'https://oasys.cubia.de/oasys-run.asp?customer=NA&ProjectID=0823317458&Test=IQT',
            'has_passing_limit' => false,
        ])->attachCourses(Course::pluck('id')->toArray());

        Test::create([
            'name' => 'Meteor16',
            'type' => Test::TYPE_METEOR,
            'description' => 'A final examination, annual, exam, final interview, or simply final, is a test given to students at the end of a course of study or training. Although the term can be used in the context of physical training, it most often occurs in the academic world.',
            'duration' => '30.00',
            'is_required' => true,
            'is_active' => true,
            'link' => 'https://projects.viq16.com/viq',
            'has_passing_limit' => true,
            'passing_limit' => 50,
        ])->attachCourses(Course::pluck('id')->toArray());
    }
}
