<?php

namespace App\Http\Controllers;

use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::where('is_active', true)->get();

        return view('teachers.index', compact('teachers'));
    }
}