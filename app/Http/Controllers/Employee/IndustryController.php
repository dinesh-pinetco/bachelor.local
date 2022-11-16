<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Option;

class IndustryController extends Controller
{
    public function create()
    {
        return view('employee.industries.manage-option');
    }

    public function edit(Option $option)
    {
        return view('employee.industries.manage-option', compact('option'));
    }

    public function clone(Option $option)
    {
        $option = $option->replicate();

        return view('employee.industries.manage-option', compact('option'));
    }
}
