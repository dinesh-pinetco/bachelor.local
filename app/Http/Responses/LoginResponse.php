<?php

namespace App\Http\Responses;

use App\Providers\RouteServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * {@inheritDoc}
     */
    public function toResponse($request)
    {
        return redirect()->intended(); //redirect(RouteServiceProvider::homeRedirectPath());
    }
}
