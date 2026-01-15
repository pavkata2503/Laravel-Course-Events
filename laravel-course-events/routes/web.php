<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController; // <--- ВАЖНО: Добавихме това
use App\Models\Course; 

/*
|--------------------------------------------------------------------------
| Публични маршрути
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    // Взимаме последните 3 курса за началната страница
    $latestCourses = Course::with('lecturer')->latest()->take(3)->get();
    return view('welcome', compact('latestCourses'));
});

/*
|--------------------------------------------------------------------------
| Табло (Dashboard) - Достъпно за всеки регистриран
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    // Взимаме последните 5 курса и общата бройка
    $courses = Course::with('lecturer', 'location')->latest()->take(5)->get();
    $coursesCount = Course::count();
    
    return view('dashboard', compact('courses', 'coursesCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Профил (Profile) - Това липсваше и даваше грешката!
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Административен панел (Само за Админи)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('admin/courses', CourseController::class)
        ->names('admin.courses');

    Route::resource('admin/lecturers', LecturerController::class)
        ->names('admin.lecturers');

    Route::resource('admin/organizations', OrganizationController::class)
        ->names('admin.organizations');

    Route::resource('admin/locations', LocationController::class)
        ->names('admin.locations');

    Route::resource('admin/users', UserController::class)
        ->only(['index', 'create', 'store', 'destroy'])
        ->names('admin.users');
});

require __DIR__.'/auth.php';