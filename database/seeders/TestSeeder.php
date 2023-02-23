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
        foreach (config('services.moodle.types') as $name => $test) {
            $this->createMoodleTest(__($name), data_get($test, 'course_id'));
        }

        Test::create([
            'name' => 'Cubia',
            'type' => Test::TYPE_CUBIA,
            'description' => __('A final examination, annual, exam, final interview, or simply final, is a test given to students at the end of a course of study or training. Although the term can be used in the context of physical training, it most often occurs in the academic world.'),
            'duration' => '60.00',
            'is_required' => true,
            'is_active' => true,
            'has_passing_limit' => false,
        ])->attachCourses(Course::pluck('id')->toArray());

        Test::create([
            'name' => 'Meteor16',
            'type' => Test::TYPE_METEOR,
            'description' => __('A final examination, annual, exam, final interview, or simply final, is a test given to students at the end of a course of study or training. Although the term can be used in the context of physical training, it most often occurs in the academic world.'),
            'duration' => '30.00',
            'is_required' => true,
            'is_active' => true,
            'has_passing_limit' => true,
            'passing_limit' => 50,
        ])->attachCourses(Course::pluck('id')->toArray());
    }

    public function createMoodleTest($name, $course_id)
    {
        Test::create([
            'name' => 'Moodle: '.$name,
            'course_id' => $course_id,
            'type' => Test::TYPE_MOODLE,
            'description' => __('Entrance Examination is the mode for getting admission into various undergraduate, post graduate and professional degree courses. Basically entrance examination is common at higher level of education which is conducted by educational institutes and colleges.'),
            'duration' => '60.00',
            'is_required' => true,
            'is_active' => true,
            'has_passing_limit' => true,
            'passing_limit' => 50,
        ])->attachCourses(Course::pluck('id')->toArray());
    }
}
