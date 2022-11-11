<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ProfileController extends Controller
{
    public function destroy(): Redirector|RedirectResponse
    {
        auth()->user()->deleteProfilePhoto();

        return redirect()->back();
    }
}
