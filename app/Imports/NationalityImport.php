<?php

namespace App\Imports;

use App\Models\Nationality;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NationalityImport implements ToModel, WithCustomCsvSettings, WithHeadingRow
{
    public $delimiter;

    public function model(array $row)
    {
        Nationality::create([
            'sana_id' => $row['id'],
            'name'    => $row['bezeichnung'],
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
