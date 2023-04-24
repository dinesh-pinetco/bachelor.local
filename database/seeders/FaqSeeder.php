<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::create([
            'name' => 'Fortschrittsbalken',
            'question' => 'Was bedeutet der Fortschrittsbalken?',
            'answer' => 'Der Fortschrittsbalken zeigt an, ob alle relevanten Informationen zu den einzelnen Unterkategorien angegeben worden sind. Steht er noch nicht auf 100%, fehlen noch Informationen.',
        ])->attachCourses(Course::pluck('id')->toArray());

        Faq::create([
            'name' => 'Nach dem Einreichen',
            'question' => 'Was passiert nach dem Einreichen meiner Bewerbung?',
            'answer' => 'Wenn Sie Ihre Bewerbung eingereicht haben, werden die Daten von uns überprüft. Anschließend werden Sie zum Auswahltest freigeschaltet.',
        ])->attachCourses(Course::inRandomOrder()->take(2)->pluck('id')->toArray());
    }
}
