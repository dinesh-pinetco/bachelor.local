<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;

class ActivityLogController extends Controller
{
    public function applicants()
    {
        return view('employee.logs.applicants');
    }

    public function courses()
    {
        return view('employee.logs.courses');
    }

    public function documents()
    {
        return view('employee.logs.documents');
    }

    public function tests()
    {
        return view('employee.logs.tests');
    }

    public function groups()
    {
        return view('employee.logs.groups');
    }

    public function settings()
    {
        return view('employee.logs.settings');
    }

    public function contactProfiles()
    {
        return view('employee.logs.contact-profiles');
    }

    public function faq()
    {
        return view('employee.logs.faq');
    }
}
