<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Tab;
use App\Models\User;

class ApplicantController extends Controller
{
    public function index()
    {
        return view('employee.applicants.index');
    }

    public function edit(User $applicant, $slug)
    {
        if ($slug == 'documents') {
            return view('application.documents', ['applicant' => $applicant, 'tab' => $slug]);
        } else {
            $tab = Tab::where('slug', $slug)->first();

            return view('application.show', compact('applicant', 'tab'));
        }
    }
}
