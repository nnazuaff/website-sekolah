<?php


use App\Http\Controllers\Public\AchievementController;
use Illuminate\Support\Facades\Route;

Route::get('/prestasi', [AchievementController::class, 'index'])->name('achievements.index');
