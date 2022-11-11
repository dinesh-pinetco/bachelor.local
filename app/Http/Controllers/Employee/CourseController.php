<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        return view('employee.courses.index');
    }

    public function create(Course $course)
    {
        return view('employee.courses.manage', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('employee.courses.manage', compact('course'));
    }
}
