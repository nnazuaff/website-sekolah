<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

Route::view('/', 'public.home');

Route::get('/berita', [NewsController::class, 'index'])->name('news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');