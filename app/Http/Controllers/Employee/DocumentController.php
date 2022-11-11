<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Document;

class DocumentController extends Controller
{
    public function index()
    {
        return view('employee.documents.index');
    }

    public function create(Document $document)
    {
        return view('employee.documents.manage', compact('document'));
    }

    public function edit(Document $document)
    {
        return view('employee.documents.manage', compact('document'));
    }
}
