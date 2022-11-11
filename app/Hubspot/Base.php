<?php

namespace App\Hubspot;

use App\Traits\Makeable;
use SevenShores\Hubspot\Factory;

abstract class Base
{
    use Makeable;

    protected $hubSpot;

    public function __construct()
    {
        $this->hubSpot = Factory::createWithOAuth2Token(
            config('services.hubspot.access_token')
        );
    }
}
