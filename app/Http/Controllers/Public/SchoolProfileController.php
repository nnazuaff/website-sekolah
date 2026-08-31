<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;

class SchoolProfileController extends Controller
{
    public function index()
    {
        return view('public.school-profile.index', [
            'schoolProfile' => SchoolProfile::query()->first(),
        ]);
    }
}
