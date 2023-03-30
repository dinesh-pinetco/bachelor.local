<?php

namespace App\Providers;

use App\Models\FieldValue;
use App\Models\Media;
use App\Models\Result;
use App\Policies\FieldValuePolicy;
use App\Policies\MediaPolicy;
use App\Policies\ResultPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
      //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
