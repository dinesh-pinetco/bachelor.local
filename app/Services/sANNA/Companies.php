<?php

namespace App\Services\sANNA;

use App\Models\Company;
use App\Models\CompanyContacts;

class Companies extends ErpService
{
    protected $endpoint = '/platform/firmen';

    public function sync()
    {
        $companies = $this->get();

        foreach ($companies as $company) {
            $companyObject = Company::updateOrCreate([
                'sana_id' => $company['id'],
            ], [
                'name' => $company['name'],
                'zip_code' => $company['plz'] ?? '',
                'meta' => json_encode($company),
            ]);

            foreach ($company['kontakte'] as $companyContact) {
                CompanyContacts::updateOrCreate([
                    'company_id' => $companyObject->id,
                    'sana_id' => $companyContact['personId'],
                ], [
                    'first_name' => $companyContact['vorname'],
                    'last_name' => $companyContact['nachname'],
                ]);
            }
        }

        Company::catchCollection();
        CompanyContacts::catchCollection();
    }
}
