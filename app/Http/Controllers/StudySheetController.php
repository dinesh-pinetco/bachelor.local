<?php

namespace App\Http\Controllers;

use App\Models\User;

class StudySheetController extends Controller
{
    public function __invoke(User $user)
    {
        return view('study-sheet', ['applicant' => $user]);
    }
}
