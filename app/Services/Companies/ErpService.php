<?php

namespace App\Services\Companies;

use App\Models\Company;
use App\Models\CompanyContacts;
use App\Traits\Makeable;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;

abstract class ErpService
{
    use Makeable;

    protected $itemsPerPage;

    protected $recordsKey = 'hydra:member';

    protected $collection;

    protected $params = [];

    public function __construct()
    {
        $this->collection = collect();

        $this->params = [
            'apikey' => config('services.nordakademie.key'),
        ];
    }

    protected function http()
    {
        return Http::baseUrl(config('services.nordakademie.baseUrl'));
    }

    public function get()
    {
        try {
            $response = $this->http()
                ->get($this->endpoint, $this->params)
                ->json();

            if (data_get($response, '@type') === 'hydra:Error') {
                $this->logError(data_get($response, 'hydra:description'));
            }

            $this->collection = collect(
                data_get($response, $this->recordsKey)
            );

            return $this->collection;
        } catch (Exception $exception) {
            $this->logError($exception->getMessage());
        }
    }

    public function hasNextPage()
    {
        return $this->collection->count() > 0;
    }

    public function nextPage()
    {
        $this->params['page'] += 1;

        return $this;
    }

    public function lastChangedAfter(Carbon $date)
    {
        $this->params['lastChanged[after]'] = $date->toDateString();

        return $this;
    }

    protected function logError($message): void
    {
        logger()->error($message, [
            'endpoint' => $this->endpoint,
            'params' => $this->params,
        ]);
    }

    public function sync()
    {
        $companies = self::make()->get();

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
    }
}
