<?php

namespace Database\Seeders;

use App\Models\StudyType;
use Illuminate\Database\Seeder;

class StudyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studyTypes = [
            'Erststudium (1. Studienabschluss -ggf. auch Promotion als Erstabschluss)',
            'Zweitstudium (Weiterer Abschluss nach dem Erststudium oder konsekutiven Masterstudium, soweit nicht Nr. 3 bis 7, auch Zweitabschluss im gleichen Studienfach)',
            'Aufbaustudium (Voraussetzung: Ein erster Abschluss)',
            'Ergänzungs-, Erweiterungs- und Zusatzstudium (z.B. bei Lehramt)',
            'Promotionsstudium (nach anderem 1. Abschluss). Prüfung auch ohne Neueinschreibung möglich.',
            'Weiterbildungsstudium (über Studiengebühren hinausgehendes kostenpflichtiges Studium)',
            'Konsekutives Masterstudium (Bachelorabschluss als einziger und zwingend vorliegender Abschluss)',
            'Weiterstudium bzw. Prüfungswiederholung zur Verbesserung der Prüfungsnote',
            'Kein Abschluss (kein Abschluss angestrebt bzw. möglich)',
        ];

        foreach ($studyTypes as $key => $studyType) {
            StudyType::create([
                'name' => $studyType,
            ]);
        }
    }
}
