<?php

use App\Http\Controllers\Public\TeacherController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'public.home')->name('home');

Route::get('/guru', [TeacherController::class, 'index'])->name('teachers.index');
