<?php

namespace App\Http\Controllers;

class DocumentController extends Controller
{
    public function __invoke()
    {
        return view('application.documents');
    }
}
