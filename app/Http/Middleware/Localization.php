<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($user = $request->user()) {
            $this->setLocale($user->locale);
        }

        return $next($request);
    }

    protected function setLocale($locale): void
    {
        app()->setLocale($locale);
    }
}
