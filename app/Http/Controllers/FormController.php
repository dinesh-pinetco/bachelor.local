<?php

namespace App\Http\Controllers;

class FormController extends Controller
{
    public function __invoke()
    {
        return auth()->user()->hasRole(ROLE_APPLICANT)
            ? view('application.forms', ['applicant' => auth()->user()])
            : view('application.forms');
    }
}
