<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;

class DesiredBeginningController extends Controller
{
    public function index()
    {
        return view('employee.desired-beginning.index');
    }
}
