<?php

namespace App\Http\Controllers;

use App\Models\StudySheet;
use App\Models\User;

class StudySheetController extends Controller
{
    public function __invoke(User $user, StudySheet $studySheet)
    {
        $this->authorize('update', $studySheet);

        return view('study-sheet', ['applicant' => $user]);
    }
}
