<?php

namespace App\Http\Controllers;

use App\Models\User;

class StudySheetController extends Controller
{
    public function __invoke(User $user)
    {
        // TODO: kishan, add policy and improve this code
        if (auth()->user()->hasRole(ROLE_APPLICANT)) {
            if ($user->id == auth()->user()->id) {
                return view('study-sheet', ['applicant' => auth()->user()]);
            } else {
                abort(403);
            }
        }

        return view('study-sheet', ['applicant' => $user]);

    }
}
