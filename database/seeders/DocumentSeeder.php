<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Document;
use App\Models\Extension;
use App\Models\User;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Document::create([
            'creator_id' => User::first()->id,
            'name' => 'CV',
            'description' => __('Upload your CV'),
            'is_required' => true,
            'is_active' => true,
        ])->attachCourses(Course::pluck('id')->toArray())->extensions()->attach(Extension::pluck('id')->toArray());

        Document::create([
            'creator_id' => User::first()->id,
            'name' => 'Testimonies',
            'description' => __('Upload your Testimonies'),
            'is_required' => true,
            'is_active' => true,
        ])->attachCourses(Course::inRandomOrder()->take(2)->pluck('id')->toArray())->extensions()->attach(Extension::pluck('id')->toArray());
    }
}
