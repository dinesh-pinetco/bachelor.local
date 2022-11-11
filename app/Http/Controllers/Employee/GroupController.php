<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Tab;

class GroupController extends Controller
{
    public function index(Tab $tab)
    {
        return view('employee.settings.groups.index', compact('tab'));
    }

    public function create(Tab $tab, Group $group)
    {
        return view('employee.settings.groups.manage', compact('tab', 'group'));
    }

    public function edit(Tab $tab, Group $group)
    {
        return view('employee.settings.groups.manage', compact('tab', 'group'));
    }
}
