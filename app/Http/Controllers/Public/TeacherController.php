<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function index()
    {
        return view('public.teachers.index');
    }
}
