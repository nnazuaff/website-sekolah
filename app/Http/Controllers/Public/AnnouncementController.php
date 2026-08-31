<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('public.announcements.index', ['announcements' => Announcement::visible()->latest('published_at')->get()]);
    }

    public function show(string $slug)
    {
        $announcement = Announcement::visible()->where('slug', $slug)->firstOrFail();

        return view('public.announcements.show', compact('announcement'));
    }
}
