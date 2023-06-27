<?php

namespace App\Services\Companies;

class GetCourse extends ErpService
{
    public function __construct()
    {
        $this->params = [
            'apikey' => config('services.nordakademie.key'),
        ];
    }

    public function get($course = null)
    {
        $this->endpoint = '/platform/studienvertrag-anhang/studiengangId='.data_get($course, 'sana_id').';startdatum='.$course?->first_start->format('Y-m-d');

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
