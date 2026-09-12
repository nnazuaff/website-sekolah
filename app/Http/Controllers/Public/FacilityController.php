<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function index()
    {
        return view('public.facilities.index', ['facilities' => Facility::where('is_active', true)->latest()->get()]);
    }
}
