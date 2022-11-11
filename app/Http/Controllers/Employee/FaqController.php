<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        return view('employee.faq.index');
    }

    public function create(Faq $faq)
    {
        return view('employee.faq.manage', compact('faq'));
    }

    public function edit(Faq $faq)
    {
        return view('employee.faq.manage', compact('faq'));
    }
}
