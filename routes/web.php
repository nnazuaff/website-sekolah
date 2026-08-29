<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;

Route::get('/storage/{path}', function (string $path) {
    $fullPath = storage_path('app/public/' . $path);

    abort_unless(file_exists($fullPath), 404);

    return response()->file($fullPath);
})->where('path', '.*');

Route::view('/', 'public.home');


Route::get('/guru', [TeacherController::class, 'index'])->name('teachers.index');