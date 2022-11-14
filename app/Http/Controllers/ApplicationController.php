<?php

namespace App\Http\Controllers;

use App\Models\Tab;

class ApplicationController extends Controller
{
    public function __invoke(Tab $tab)
    {
        $applicant = auth()->user();

        return view('application.show', compact('tab', 'applicant'));
    }
}
