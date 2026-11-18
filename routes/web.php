<?php

use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LessonController as AdminLessonController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\StudyGroupController as AdminStudyGroupController;
use App\Http\Controllers\Admin\TeacherController as AdminTeacherController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Site\ApplicationController;
use App\Http\Controllers\Site\CourseController;
use App\Http\Controllers\Site\PageController;
use App\Http\Controllers\Site\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public site
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/kurslar', [CourseController::class, 'index'])->name('courses.index');
Route::get('/kurslar/{course:slug}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/oqituvchilar', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/markaz-haqida', [PageController::class, 'about'])->name('about');
Route::get('/aloqa', [PageController::class, 'contact'])->name('contact');

Route::post('/ariza', [ApplicationController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('applications.store');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/kirish', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/kirish', [AuthController::class, 'login'])->name('login.store');

    Route::get('/royxatdan-otish', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/royxatdan-otish', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/chiqish', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Student cabinet
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:student'])
    ->prefix('kabinet')
    ->name('cabinet.')
    ->group(function () {
        Route::get('/', [CabinetController::class, 'index'])->name('dashboard');
        Route::get('/guruhlar/{group}', [CabinetController::class, 'group'])->name('group');
        Route::get('/tolovlar', [CabinetController::class, 'payments'])->name('payments');
    });

/*
|--------------------------------------------------------------------------
| Admin panel
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('courses', AdminCourseController::class)->except('show');
        Route::resource('teachers', AdminTeacherController::class)->except('show');
        Route::resource('students', AdminStudentController::class)->except('show');

        Route::resource('groups', AdminStudyGroupController::class);
        Route::post('groups/{group}/students', [AdminStudyGroupController::class, 'storeStudent'])
            ->name('groups.students.store');
        Route::delete('groups/{group}/students/{student}', [AdminStudyGroupController::class, 'destroyStudent'])
            ->name('groups.students.destroy');

        Route::post('groups/{group}/lessons', [AdminLessonController::class, 'store'])
            ->name('groups.lessons.store');
        Route::get('lessons/{lesson}', [AdminLessonController::class, 'show'])->name('lessons.show');
        Route::delete('lessons/{lesson}', [AdminLessonController::class, 'destroy'])->name('lessons.destroy');
        Route::post('lessons/{lesson}/attendance', [AdminAttendanceController::class, 'store'])
            ->name('lessons.attendance.store');

        Route::resource('applications', AdminApplicationController::class)->only(['index', 'update', 'destroy']);
        Route::resource('payments', AdminPaymentController::class)->only(['index', 'create', 'store', 'destroy']);
    });
