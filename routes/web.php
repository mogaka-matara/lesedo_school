<?php

use App\Http\Controllers\Backend\FeeController;
use App\Http\Controllers\Backend\GradeController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Backend\TermController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('admin.pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //grade routes
    Route::resource('grade', GradeController::class);

    //student routes
    Route::resource('student', StudentController::class);

    //fee route
    Route::resource('fees', FeeController::class);

    //terms routes
    Route::resource('term', TermController::class);
});

require __DIR__.'/auth.php';
