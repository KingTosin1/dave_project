<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Student Routes
    Route::middleware(['role:student'])->prefix('student')->name('student.')->group(function () {
        Route::get('/register-courses', [StudentController::class, 'registerCourses'])->name('register');
        Route::post('/register-courses', [StudentController::class, 'storeRegistration'])->name('store_registration');
        Route::get('/results', [StudentController::class, 'viewResults'])->name('results');
        Route::get('/transcript', [StudentController::class, 'printTranscript'])->name('transcript');
    });

    // Lecturer Routes
    Route::middleware(['role:lecturer'])->prefix('lecturer')->name('lecturer.')->group(function () {
        Route::get('/courses', [LecturerController::class, 'assignedCourses'])->name('courses');
        Route::get('/courses/{courseId}/upload-marks', [LecturerController::class, 'uploadMarks'])->name('upload_marks');
        Route::post('/courses/{courseId}/upload-marks', [LecturerController::class, 'storeMarks'])->name('store_marks');
        Route::get('/courses/{courseId}/edit-marks', [LecturerController::class, 'editMarks'])->name('edit_marks');
        Route::put('/courses/{courseId}/edit-marks', [LecturerController::class, 'updateMarks'])->name('update_marks');
    });

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        // Students
        Route::get('/students', [AdminController::class, 'studentsIndex'])->name('students.index');
        Route::get('/students/create', [AdminController::class, 'create'])->name('students.create');
        Route::post('/students', [AdminController::class, 'store'])->name('students.store');
        Route::get('/students/{student}/edit', [AdminController::class, 'edit'])->name('students.edit');
        Route::put('/students/{student}', [AdminController::class, 'update'])->name('students.update');
        Route::delete('/students/{student}', [AdminController::class, 'destroy'])->name('students.destroy');
        // Lecturers
        Route::get('/lecturers', [AdminController::class, 'lecturers'])->name('lecturers.index');
        Route::get('/lecturers/create', [AdminController::class, 'createLecturer'])->name('lecturers.create');
        Route::post('/lecturers', [AdminController::class, 'storeLecturer'])->name('lecturers.store');
        Route::delete('/lecturers/{id}', [AdminController::class, 'deleteLecturer'])->name('lecturers.destroy');
        // Courses
        Route::get('/courses', [AdminController::class, 'courses'])->name('courses.index');
        Route::get('/courses/create', [AdminController::class, 'createCourse'])->name('courses.create');
        Route::post('/courses', [AdminController::class, 'storeCourse'])->name('courses.store');
        Route::delete('/courses/{course}', [AdminController::class, 'deleteCourse'])->name('courses.destroy');
        // Registrations
        Route::get('/registrations', [AdminController::class, 'registrations'])->name('registrations.index');
        Route::post('/registrations/{id}/approve', [AdminController::class, 'approveRegistration'])->name('registrations.approve');
        Route::delete('/registrations/{id}', [AdminController::class, 'rejectRegistration'])->name('registrations.reject');
        // Assignments
        Route::get('/assign-courses', [AdminController::class, 'assignCourses'])->name('assign_courses');
        Route::post('/assign-courses', [AdminController::class, 'storeAssignment'])->name('store_assignment');
        Route::delete('/assignments/{id}', [AdminController::class, 'removeAssignment'])->name('remove_assignment');
        // Results
        Route::get('/results', [AdminController::class, 'results'])->name('results');
    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
