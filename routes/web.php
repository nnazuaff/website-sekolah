<?php

use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\SchoolProfileController;
use App\Http\Controllers\Public\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [SchoolProfileController::class, 'index'])->name('school-profile.index');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::get('/guru', [TeacherController::class, 'index'])->name('teachers.index');
