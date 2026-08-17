<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\MajorController;

Route::view('/', 'public.home');

Route::get('/jurusan', [MajorController::class, 'index'])->name('public.majors.index');
Route::get('/jurusan/{slug}', [MajorController::class, 'show'])->name('public.majors.show');