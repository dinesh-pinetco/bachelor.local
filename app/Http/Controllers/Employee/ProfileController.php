<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function __invoke()
    {
        return view('employee.profile');
    }
}
