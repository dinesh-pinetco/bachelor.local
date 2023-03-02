<?php

namespace App\Http\Controllers;

use App\Models\User;

class DocumentController extends Controller
{
    public function __invoke()
    {
        $this->authorize('view', User::class);

        return view('application.documents');
    }
}
