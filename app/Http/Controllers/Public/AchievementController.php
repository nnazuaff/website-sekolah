<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Achievement;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::latest('year')
            ->latest('achievement_date')
            ->get();

        return view('public.achievements.index', compact('achievements'));
    }
}