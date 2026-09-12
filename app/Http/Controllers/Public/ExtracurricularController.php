<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;
use Illuminate\View\View;

class ExtracurricularController extends Controller
{
    public function index(): View
    {
        $extracurriculars = Extracurricular::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('public.extracurriculars.index', compact('extracurriculars'));
    }
}
