<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController; 
use App\Models\Course; 

Route::get('/', function () {
    $latestCourses = Course::with('lecturer')->latest()->take(3)->get();
    return view('welcome', compact('latestCourses'));
});

Route::get('/dashboard', function () {
    $courses = Course::with('lecturer', 'location')->latest()->take(5)->get();
    $coursesCount = Course::count();
    
    return view('dashboard', compact('courses', 'coursesCount'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('admin/courses', CourseController::class)
        ->names('admin.courses');

Route::middleware(['auth', 'admin'])->group(function () {

    

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