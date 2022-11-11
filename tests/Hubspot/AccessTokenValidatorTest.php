<?php

namespace Tests\Hubspot;

use App\Exceptions\Hubspot\AccessTokenNotValid;
use App\Hubspot\AccessTokenValidator;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class AccessTokenValidatorTest extends TestCase
{
    /** @test */
    public function access_token_is_valid()
    {
        $is_validated = AccessTokenValidator::make()->accessTokenIsValid();

        $this->assertTrue($is_validated);
    }

    /** @test */
    public function access_token_has_enough_scopes()
    {
        $missingScopes = AccessTokenValidator::make()->getMissingScopes();

        $this->assertEmpty($missingScopes);
    }

    /** @test */
    public function error_for_invalid_access_token()
    {
        $this->expectException(AccessTokenNotValid::class);
        Config::set('services.hubspot.access_token', 'invalid-token');

        $is_validated = AccessTokenValidator::make()->handle();

        $this->assertFalse($is_validated);
    }
}
