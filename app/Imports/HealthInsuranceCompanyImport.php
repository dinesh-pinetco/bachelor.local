<?php

namespace App\Imports;

use App\Models\HealthInsuranceCompany;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HealthInsuranceCompanyImport implements ToModel, WithCustomCsvSettings, WithHeadingRow
{
    public $delimiter;

    public function model(array $row)
    {
        HealthInsuranceCompany::create([
            'sana_id'                                    => $row['id'],
            'short_description'                          => $row['kurzbezeichnung'],
            'name1'                                      => $row['name1'],
            'name2'                                      => $row['name2'],
            'name3'                                      => $row['name3'],
            'company_number'                             => $row['betriebsnummer'],
            'institution_identifier'                     => $row['institutionskennzeichen'],
            'establishment_number_data_receiving_office' => $row['betriebsnummer_datenannahmestelle'],
            'ik_this_user'                               => $row['ik_das_nutzer'],
            'ik_this_physical'                           => $row['ik_das_physikalisch'],
            'valid_until'                                => $row['gueltig_bis'],
            'succession_bn'                              => $row['nachfolge_bn'],
            'version'                                    => $row['version'],
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
