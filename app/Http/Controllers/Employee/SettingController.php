<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Tab;

class SettingController extends Controller
{
    public function index(Tab $tab)
    {
        return view('employee.settings.index', compact('tab'));
    }

    public function create(Tab $tab, Field $field)
    {
        return view('employee.settings.manage', compact('tab', 'field'));
    }

    public function edit(Tab $tab, Field $field)
    {
        return view('employee.settings.manage', compact('tab', 'field'));
    }
}
