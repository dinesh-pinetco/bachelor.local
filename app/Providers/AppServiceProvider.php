<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Component;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Component::macro('toastNotify', function ($message, $title = '', $type = 'success') {
            $this->dispatchBrowserEvent('notify', ['message' => $message, 'title' => $title, 'type' => $type]);
        });
    }
}
