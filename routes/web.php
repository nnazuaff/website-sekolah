<?php

use App\Http\Controllers\Public\AchievementController;
use App\Http\Controllers\Public\AnnouncementController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\ExtracurricularController;
use App\Http\Controllers\Public\FacilityController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\MajorController;
use App\Http\Controllers\Public\NewsController;
use App\Http\Controllers\Public\SchoolProfileController;
use App\Http\Controllers\Public\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [SchoolProfileController::class, 'index'])->name('school-profile.index');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::get('/guru', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/prestasi', [AchievementController::class, 'index'])->name('achievements.index');
Route::get('/ekstrakurikuler', [ExtracurricularController::class, 'index'])->name('extracurriculars.index');
Route::get('/jurusan', [MajorController::class, 'index'])->name('majors.index');
Route::get('/jurusan/{slug}', [MajorController::class, 'show'])->name('majors.show');
Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');
Route::get('/fasilitas', [FacilityController::class, 'index'])->name('fasilitas.index');
Route::get('/pengumuman', [AnnouncementController::class, 'index'])->name('pengumuman.index');
Route::get('/pengumuman/{slug}', [AnnouncementController::class, 'show'])->name('pengumuman.show');
