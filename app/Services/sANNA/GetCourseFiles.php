<?php

namespace App\Services\sANNA;

class GetCourseFiles extends ErpService
{
    public $parameter;

    public function __construct()
    {
        $this->params = [
            'apikey' => config('services.nordakademie.key'),
        ];
    }

    public function getFile($paramater = null)
    {
        try {
            $response = $this->http()
                ->get('/platform/studienvertrag-anhang-pdf/'.$paramater, $this->params)
                ->json();

            return collect($response);
        } catch (\Exception $exception) {
            $this->logError($exception->getMessage());
        }
    }
}
