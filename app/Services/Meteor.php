<?php

namespace App\Services;

use App\Models\Result;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Meteor
{
    public User $user;

    public string $f;

    public $naTan;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->naTan = $this->user->meteor->na_tan;
        $this->f = '%7B%22naTan%22%3A%22%7B'.$this->naTan.'%7D%22%7D';
    }

    public function generateTestUrl(): string
    {
        $testUrl = '';
        if ($this->naTan) {
            $testUrl = config('services.meteor.base_url').'&f='.$this->f;
        }

        return $testUrl;
    }

    public function fetchResult($result)
    {
        if ($this->naTan) {
            $url = 'https://kern.viq16.com/api/transaction/result_report'.
                '?p='.config('services.meteor.p').
                '&t='.$this->user->meteor->t.
                '&f='.$this->f;

            $response = Http::get($url);
            $responseJson = json_decode(get_string_between($response->body(), '<code>', '</code>'));

            if (data_get($responseJson, 'exception')) {
                Log::error('Meteor fetch-result API response: ', [
                    'requested_url' => $url,
                    'response' => $responseJson,
                    'user' => $this->user,
                ]);

                return str_replace('error/', '', html_entity_decode(data_get($responseJson, 'message')));
            }

            $grade = data_get($responseJson, 'viq-3.full');

            $status = $grade != null ? Result::STATUS_COMPLETED : $result->status;

            $result->update(['status' => $status, 'is_passed' => $grade != null, 'result' => data_get($responseJson, 'meta_data.report_url'), 'meta' => json_encode($responseJson)]);

            return $grade;
        }
    }
}
