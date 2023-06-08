<?php

namespace App\Http\Controllers;

class FormController extends Controller
{
    public function __invoke()
    {
        if (auth()->user()->hasRole(ROLE_APPLICANT)) {
            return view('application.forms', ['applicant' => auth()->user()]);
        }

        return view('application.forms');
    }
}
