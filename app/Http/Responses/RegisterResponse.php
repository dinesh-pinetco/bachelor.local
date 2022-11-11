<?php

namespace App\Http\Responses;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class RegisterResponse extends \Laravel\Fortify\Http\Responses\RegisterResponse
{
    public function toResponse($request): Redirector|RedirectResponse
    {
        auth()->logout();

        return redirect()->route('login')
            ->with(['message' => __('We have send you an email please check to complete you registration!')]);
    }
}
