<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\View\View;

class AchievementController extends Controller
{
    public function index(): View
    {
        $achievements = Achievement::query()
            ->latest('achievement_date')
            ->latest('id')
            ->get();

        return view('public.achievements.index', compact('achievements'));
    }
}
