<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationSubmit;
use App\Models\Tab;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    public function __invoke(Tab $tab)
    {
        $applicant = auth()->user();

        return view('application.show', compact('tab', 'applicant'));
    }

    public function submitApplication()
    {
        $applicant = auth()->user();

        $employee = User::role(ROLE_EMPLOYEE)->latest()->first();

        Mail::to($applicant->email)
            ->cc(config('mail.supporter.address'))
            ->send(new ApplicationSubmit($applicant, $employee));
        $applicant->application_status_id = USER::STATUS_APPLICATION_SUBMITTED;
        $applicant->save();

        return back()->with('message', __('Message Sent Successfully!!'));
    }
}
