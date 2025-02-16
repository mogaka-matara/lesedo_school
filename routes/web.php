<?php

use App\Http\Controllers\Backend\AcademicYearController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\FeeComponentController;
use App\Http\Controllers\Backend\FeeController;
use App\Http\Controllers\Backend\GradeController;
use App\Http\Controllers\Backend\LibraryController;
use App\Http\Controllers\Backend\PromotionController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Backend\SubjectController;
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

    Route::resource('fee-component', FeeComponentController::class);

    Route::resource('academic-year', AcademicYearController::class);


    Route::get('/students-by-grade', [PromotionController::class, 'getStudentsByGrade'])->name('students.by.grade');
    Route::resource('promotion', PromotionController::class);

    //library Routes
    Route::resource('library', BookController::class);


    Route::get('library-borrowed-books', [LibraryController::class, 'index'])->name('borrowedBooks');
    Route::post('library/borrow', [LibraryController::class, 'borrow'])->name('library.borrow-store');
    Route::put('return/{id}', [LibraryController::class, 'returnBook'])->name('library.return');

    //subject creation routes
    Route::get('all-subjects', [SubjectController::class, 'index'])->name('all.subjects');
    Route::post('all-subjects', [SubjectController::class, 'getSubjects'])->name('store.subject');
});

require __DIR__.'/auth.php';
