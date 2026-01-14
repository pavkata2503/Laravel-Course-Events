<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
    
use App\Http\Controllers\CourseController;

// ... (другите ти routes са тук)

// Добавяме ресурсния път за курсовете
// prefix('admin') прави URL-а да изглежда така: /admin/courses
Route::resource('admin/courses', CourseController::class)
    ->names('admin.courses');
require __DIR__.'/auth.php';
