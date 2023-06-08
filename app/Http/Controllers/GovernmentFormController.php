<?php

namespace App\Http\Controllers;

use App\Models\User;

class GovernmentFormController extends Controller
{
    public function __invoke(User $user)
    {
        $this->authorize('viewGovernmentForm', $user);

        return view('government-form', ['applicant' => $user]);
    }
}
