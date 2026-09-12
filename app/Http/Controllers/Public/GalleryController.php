<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        return view('public.gallery.index', ['galleries' => Gallery::latest('taken_at')->latest()->get()]);
    }
}
