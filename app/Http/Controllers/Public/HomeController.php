<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Announcement;
use App\Models\News;
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
            'latestNews' => News::query()
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now())
                ->latest('published_at')
                ->take(3)
                ->get(),
            'latestAchievements' => Achievement::query()
                ->latest('achievement_date')
                ->latest('id')
                ->take(3)
                ->get(),
            'latestAnnouncements' => Announcement::visible()
                ->latest('published_at')
                ->take(4)
                ->get(),
        ]);
    }
}
