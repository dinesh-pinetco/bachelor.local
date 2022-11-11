<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('admin.employee.index');
    }

    public function create()
    {
        return view('admin.employee.manage', [
            'employee' => new User(),
        ]);
    }

    public function edit(User $employee)
    {
        return view('admin.employee.manage', compact('employee'));
    }
}
