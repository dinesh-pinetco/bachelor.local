<?php

namespace App\Hubspot;

use App\Exceptions\Hubspot\AccessTokenNotValid;
use App\Exceptions\Hubspot\ScopesAreMissing;
use App\Traits\Makeable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class AccessTokenValidator
{
    use Makeable;

    public $accessToken;

    /**
     * @param $accessToken
     */
    public function __construct()
    {
        $this->accessToken = config('services.hubspot.access_token');
    }

    public function handle()
    {
        return $this->accessTokenIsValid() && $this->scopesAreValid() ?: throw new AccessTokenNotValid(__('Access token is invalid.'));
    }

    public function accessTokenIsValid()
    {
        return $this->getAccessTokenInformation()->successful();
    }

    public function getAccessTokenInformation()
    {
        return Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://api.hubapi.com/oauth/v2/private-apps/get/access-token-info', [
            'tokenKey' => $this->accessToken,
        ]);
    }

    protected function scopesAreValid()
    {
        $accessTokenInfo = $this->getAccessTokenInformation();

        if ($accessTokenInfo->failed()) {
            return false;
        }

        $missingScopes = $this->getMissingScopes();

        if (count($missingScopes)) {
            throw new ScopesAreMissing(__('Following scopes are missing:').implode(', ', $missingScopes));
        }

        return true;
    }

    public function getMissingScopes()
    {
        $accessTokenInfo = $this->getAccessTokenInformation();
        $userScopes = data_get($accessTokenInfo, 'scopes', []);
        $requiredScopes = config('services.hubspot.required_scopes');

        return Arr::where($requiredScopes, function ($value) use ($userScopes) {
            return ! in_array($value, $userScopes);
        });
    }
}
