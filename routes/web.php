<?php

use App\Http\Controllers\Public\AchievementController;
use App\Http\Controllers\Public\ExtracurricularController;
use App\Http\Controllers\Public\TeacherController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'public.home')->name('home');

Route::get('/guru', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/prestasi', [AchievementController::class, 'index'])->name('achievements.index');
Route::get('/ekstrakurikuler', [ExtracurricularController::class, 'index'])->name('extracurriculars.index');
