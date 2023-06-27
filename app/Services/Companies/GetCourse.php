<?php

namespace App\Services\Companies;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class GetCourse
{

    protected $params = [];
    public function __construct()
    {
        $this->params = [
            'apikey' => config('services.nordakademie.key'),
        ];
    }

    public function get($sanaId, Carbon $desiredBeginningDate)
    {
        $endpoint = '/platform/studienvertrag-anhang/studiengangId='. $sanaId .';startdatum='. $desiredBeginningDate->format('Y-m-d');

        try {
            $response = Http::baseUrl(config('services.nordakademie.baseUrl'))
                ->get($endpoint, $this->params)
                ->json();

            if (data_get($response, '@type') === 'hydra:Error') {
                $this->logError(data_get($response, 'hydra:description'),$endpoint);
            }

            return collect($response);
        } catch (\Exception $exception) {
            $this->logError($exception->getMessage(),$endpoint);
        }
    }

    protected function logError($message, $endpoint): void
    {
        logger()->error($message, [
            'endpoint' => $endpoint,
            'params' => $this->params,
        ]);
    }
}
