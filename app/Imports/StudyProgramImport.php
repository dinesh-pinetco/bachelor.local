<?php

namespace App\Imports;

use App\Models\StudyProgram;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudyProgramImport implements ToModel, WithCustomCsvSettings, WithHeadingRow
{
    public $delimiter;

    public function model(array $row)
    {
        StudyProgram::create([
            'sana_id' => $row['id'],
            'name' => $row['bezeichnung'],
            'in_active' => $row['inaktiv'],
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
            'delimiter' => ';',
        ];
    }
}
