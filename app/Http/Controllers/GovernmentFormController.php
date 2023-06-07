<?php

namespace App\Http\Controllers;

use App\Models\User;

class GovernmentFormController extends Controller
{
    public function __invoke(User $user)
    {
        if (auth()->user()->hasRole(ROLE_APPLICANT)) {
            if ($user->id == auth()->user()->id) {
                return view('government-form', ['applicant' => auth()->user()]);
            } else {
                abort(403);
            }
        }

        return view('government-form', ['applicant' => $user]);
    }
}
