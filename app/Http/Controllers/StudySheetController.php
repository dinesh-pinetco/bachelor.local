<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudySheetController extends Controller
{
    public function __invoke(User $user)
    {
        return view('study-sheet', ['applicant' => $user]);
    }
}
