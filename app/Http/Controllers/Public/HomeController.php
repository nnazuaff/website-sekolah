<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use App\Models\Teacher;

class HomeController extends Controller
{
    public function index()
    {
        return view('public.home', [
            'schoolProfile' => SchoolProfile::query()->first(),
            'activeTeachers' => Teacher::query()
                ->where('is_active', true)
                ->latest()
                ->take(6)
                ->get(),
        ]);
    }
}
