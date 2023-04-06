<?php

namespace App\Imports;

use App\Models\City;
use App\Models\School;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SchoolImport implements ToModel, WithCustomCsvSettings, WithHeadingRow
{
    public $delimiter;

    public function model(array $row)
    {
        $schoolsCity = City::updateOrCreate(['name' => $row['stadt']]);

        School::create([
            'name' => $row['name_der_schule'],
            'strasse' => $row['adresszeile_strasse_u_hausnr'],
            'plz' => $row['postleitzahl'],
            'city_id' => $schoolsCity->id,
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
