<?php

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\CourseAddComponent;
use App\Http\Livewire\Admin\CourseComponent;
use App\Http\Livewire\Admin\CourseEditComponent;
use App\Http\Livewire\Admin\EnrollmentComponent;
use App\Http\Livewire\Admin\ProgramsAddComponent;
use App\Http\Livewire\Admin\ProgramsComponent;
use App\Http\Livewire\Admin\ProgramsEditComponent;
use App\Http\Livewire\Admin\SchoolYearAddComponent;
use App\Http\Livewire\Admin\SchoolYearComponent;
use App\Http\Livewire\Admin\SchoolYearEditComponent;
use App\Http\Livewire\Admin\StudentsComponent;
use App\Http\Livewire\Admin\StudentsEditComponent;
use App\Http\Livewire\Admin\SubjectAddComponent;
use App\Http\Livewire\Admin\SubjectComponent;
use App\Http\Livewire\Admin\SubjectEditComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\User\UserProfileComponent;
use App\Http\Livewire\User\UserProfileEditComponent;
use Illuminate\Support\Facades\Route;



Route::get('/', HomeComponent::class)->name('home');

// users
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->prefix('user')->name('user.')->group(function () {
    Route::get('/profile', UserProfileComponent::class)->name('profile');
    Route::get('/profile/edit', UserProfileEditComponent::class)->name('profile.edit');
});

// admin
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 'role_or_permission:super-admin|dashboard-access|admin'
])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', AdminDashboardComponent::class)->name('dashboard');

    Route::get('/subject', SubjectComponent::class)->name('subject.index');
    Route::get('/subject/create', SubjectAddComponent::class)->name('subject.create');
    Route::get('/subject/{subject_id}/edit', SubjectEditComponent::class)->name('subject.edit');

    Route::get('/school-year', SchoolYearComponent::class)->name('schoolyear.index');
    Route::get('/school-year/create', SchoolYearAddComponent::class)->name('schoolyear.create');
    Route::get('/school-year/{school_year_id}/edit', SchoolYearEditComponent::class)->name('schoolyear.edit');

    Route::get('/course', CourseComponent::class)->name('course.index');
    Route::get('/course/create', CourseAddComponent::class)->name('course.create');
    Route::get('/course/{course_id}/edit', CourseEditComponent::class)->name('course.edit');

    Route::get('/enrollment', EnrollmentComponent::class)->name('enrollment.index');

    Route::get('/program', ProgramsComponent::class)->name('program.index');
    Route::get('/program/create', ProgramsAddComponent::class)->name('program.create');
    Route::get('/program/{program_id}/edit', ProgramsEditComponent::class)->name('program.edit');

    Route::get('/student', StudentsComponent::class)->name('student.index');
    Route::get('/student/{student_id}/edit', StudentsEditComponent::class)->name('student.edit');

});

