<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\User;

class InterviewController extends Controller
{
    public function show(User $applicant, Interview $interview)
    {
        return view('employee.applicants.interviews.show', compact('applicant', 'interview'));
    }
}
