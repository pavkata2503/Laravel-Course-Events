<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Публични маршрути (достъпни за всички)
|--------------------------------------------------------------------------
*/
Route::view('/', 'welcome');

/*
|--------------------------------------------------------------------------
| Маршрути за регистрирани потребители (Admin + User)
|--------------------------------------------------------------------------
| Тук слагаме нещата, които всеки регистриран може да вижда.
*/
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
     // 1. Курсове
    Route::resource('admin/courses', CourseController::class)
        ->names('admin.courses');

/*
|--------------------------------------------------------------------------
| Маршрути САМО ЗА АДМИНИСТРАТОРИ
|--------------------------------------------------------------------------
| Тук използваме група с middleware ['auth', 'admin'].
| 'auth' -> проверява дали си логнат.
| 'admin' -> проверява дали is_admin е 1 (твоя нов middleware).
*/
Route::middleware(['auth', 'admin'])->group(function () {

   

    // 2. Преподаватели
    Route::resource('admin/lecturers', LecturerController::class)
        ->names('admin.lecturers');

    // 3. Организации
    Route::resource('admin/organizations', OrganizationController::class)
        ->names('admin.organizations');

    // 4. Населени места
    Route::resource('admin/locations', LocationController::class)
        ->names('admin.locations');

    // 5. Управление на потребители (Роли)
    Route::resource('admin/users', UserController::class)
        ->only(['index', 'create', 'store', 'destroy'])
        ->names('admin.users');

});

require __DIR__.'/auth.php';