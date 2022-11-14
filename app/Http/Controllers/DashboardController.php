<?php

namespace App\Http\Controllers;

use App\Services\ApplicantRedirection;

class DashboardController extends Controller
{
    public function __invoke()
    {
        if (auth()->user()->hasRole(ROLE_APPLICANT)) {
            return ApplicantRedirection::make(auth()->user())->route();
        }

        return redirect(route('employee.dashboard'));
    }
}
