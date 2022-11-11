<?php

namespace App\Providers;

use App\Models\Contract;
use App\Models\FieldValue;
use App\Models\Interview;
use App\Models\Result;
use App\Policies\ContractPolicy;
use App\Policies\FieldValuePolicy;
use App\Policies\InterviewPolicy;
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
        FieldValue::class => FieldValuePolicy::class,
        Result::class => ResultPolicy::class,
        Interview::class => InterviewPolicy::class,
        Contract::class => ContractPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
