<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Major;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::query()->where('is_active', true)->orderBy('name')->get();

        return view('public.majors.index', compact('majors'));
    }

    public function show(string $slug)
    {
        $major = Major::query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('public.majors.show', compact('major'));
    }
}
