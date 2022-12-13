<?php

namespace App\Imports;

use App\Models\School;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SchoolImport implements ToModel, WithCustomCsvSettings, WithHeadingRow
{
    public $delimiter;

    public function model(array $row)
    {
        School::create([
            'sana_id' => $row['id'],
            'name' => $row['name'],
            'strasse' => $row['strasse'],
            'plz' => $row['plz'],
            'ort' => $row['ort'],
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
