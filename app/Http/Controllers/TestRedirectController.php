<?php

namespace App\Http\Controllers;

use App\Models\Test;

class TestRedirectController extends Controller
{
    public function __invoke(Test $test)
    {
        $this->authorize('perform', $test);

        $test->getTestLink(auth()->user());

        return redirect()->away('https://auswahltest.nordakademie.de/moodle/course/view.php?id='.$test->course_id);
    }
}
