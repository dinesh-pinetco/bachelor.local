<?php

namespace App\Http\Controllers;

use App\Models\GovernmentForm;
use App\Models\User;

class GovernmentFormController extends Controller
{
    public function __invoke(User $user, GovernmentForm $governmentForm)
    {
        return view('government-form', ['applicant' => $user]);
    }
}
