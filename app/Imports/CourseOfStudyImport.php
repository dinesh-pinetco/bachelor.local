<?php

namespace App\Imports;

use App\Models\CourseOfStudy;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseOfStudyImport implements ToModel, WithCustomCsvSettings, WithHeadingRow
{
    public $delimiter;

    public function model(array $row)
    {
        CourseOfStudy::create([
            'sana_id'          => $row['id'],
            'short_form'       => $row['kurzform'],
            'name'             => $row['bezeichnung'],
            'name_en'          => $row['bezeichnung_en'],
            'title'            => $row['titel'],
            'title_short'      => $row['titel_kurz'],
            'study_program_id' => $row['id_repasentation_fur_schlussel_41'],
        ]);
    }

    public function setDelimiter(string $delimiter): self
    {
        $this->delimiter = $delimiter;

        return $this;
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'ISO-8859-1',
            'delimiter'      => ';',
        ];
    }
}
