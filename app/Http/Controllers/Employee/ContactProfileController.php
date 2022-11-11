<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\ContactProfile;

class ContactProfileController extends Controller
{
    public function index()
    {
        return view('employee.contact-profiles.index');
    }

    public function create(ContactProfile $contactProfile)
    {
        return view('employee.contact-profiles.manage', compact('contactProfile'));
    }

    public function edit(ContactProfile $contactProfile)
    {
        return view('employee.contact-profiles.manage', compact('contactProfile'));
    }
}
