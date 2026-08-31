<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;  

use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
{
    return view('teachers.index');
}
}