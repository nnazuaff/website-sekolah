<?php

use App\Http\Controllers\Public\AnnouncementController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\FacilityController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\SchoolProfileController;
use App\Http\Controllers\Public\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [SchoolProfileController::class, 'index'])->name('school-profile.index');
Route::get('/guru', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');
Route::get('/fasilitas', [FacilityController::class, 'index'])->name('fasilitas.index');
Route::get('/pengumuman', [AnnouncementController::class, 'index'])->name('pengumuman.index');
Route::get('/pengumuman/{slug}', [AnnouncementController::class, 'show'])->name('pengumuman.show');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
