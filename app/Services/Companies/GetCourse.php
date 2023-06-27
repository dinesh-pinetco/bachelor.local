<?php

namespace App\Services\Companies;

use Carbon\Carbon;

class GetCourse extends ErpService
{
    public function __construct()
    {
        $this->params = [
            'apikey' => config('services.nordakademie.key'),
        ];
    }

    public function get($sanaId, Carbon $desiredBeginningDate)
    {
        $this->endpoint = '/platform/studienvertrag-anhang/studiengangId='. $sanaId .';startdatum='. $desiredBeginningDate->format('Y-m-d');

        try {
            $response = $this->http()
                ->get($this->endpoint, $this->params)
                ->json();

            if (data_get($response, '@type') === 'hydra:Error') {
                $this->logError(data_get($response, 'hydra:description'));
            }

            return collect($response);
        } catch (\Exception $exception) {
            $this->logError($exception->getMessage());
        }
    }
}
