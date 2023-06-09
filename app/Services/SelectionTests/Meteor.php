<?php

namespace App\Services\SelectionTests;

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
        $this->user = $user->load('meteor');
        $this->naTan = $this->user->meteor->na_tan;

        $this->f = sprintf('{"naTan":"{%s}"}', $this->naTan);
    }

    public function generateTestUrl(): string
    {
        $testUrl = '';
        if ($this->naTan) {
            $testUrl = config('services.meteor.base_url').'&f='.$this->f;
        }

        return $testUrl;
    }

    public function fetchResult(Result $result)
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
            $result->updateTestResult((bool) $grade, data_get($responseJson, 'meta_data.report_url'), json_encode($responseJson));

            return $grade;
        }
    }
}
