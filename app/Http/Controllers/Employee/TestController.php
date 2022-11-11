<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Test;

class TestController extends Controller
{
    public function index()
    {
        return view('employee.tests.index');
    }

    public function create(Test $test)
    {
        return view('employee.tests.manage', compact('test'));
    }

    public function edit(Test $test)
    {
        return view('employee.tests.manage', compact('test'));
    }
}
