<?php

namespace App\Http\Controllers;

use App\Models\Test;

class TestRedirectController extends Controller
{
    public function __invoke(Test $test)
    {
        $this->authorize('perform', $test);

        return redirect()->away($test->getTestLink(auth()->user()));
    }
}
