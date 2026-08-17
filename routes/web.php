<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;

Route::view('/', 'public.home');


Route::get('/guru', [TeacherController::class, 'index'])->name('teachers.index');