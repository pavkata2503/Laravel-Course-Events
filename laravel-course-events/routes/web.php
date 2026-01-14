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

Route::resource('admin/lecturers', \App\Http\Controllers\LecturerController::class)
    ->names('admin.lecturers');

// ... (другите ти routes са тук)
Route::resource('admin/organizations', \App\Http\Controllers\OrganizationController::class)
    ->names('admin.organizations');
// Добавяме ресурсния път за курсовете
// prefix('admin') прави URL-а да изглежда така: /admin/courses
Route::resource('admin/courses', CourseController::class)
    ->names('admin.courses');
require __DIR__.'/auth.php';
