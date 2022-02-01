<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CoursesController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('estudiantes', [UserController::class, 'index'])->name('users.home');
Route::post('estudiantes', [UserController::class, 'update'])->name('users.update');

Route::get('estudiantes/{id}', [UserController::class, 'put'])->name('users.index');
Route::put('estudiantes/{id}', [UserController::class, 'change'])->name('users.change');
Route::delete('estudiantes/{id}', [UserController::class, 'delete'])->name('users.delete');

// Teachers
Route::get('profesores', [TeacherController::class, 'index'])->name('teachers.home');
Route::post('profesores', [TeacherController::class, 'update'])->name('teachers.update');

Route::get('profesores/{id}', [TeacherController::class, 'put'])->name('teachers.index');
Route::put('profesores/{id}', [TeacherController::class, 'change'])->name('teachers.change');
Route::delete('profesores/{id}', [TeacherController::class, 'delete'])->name('teachers.delete');

// Courses
Route::get('materias', [CoursesController::class, 'index'])->name('courses.home');
Route::post('materias', [CoursesController::class, 'update'])->name('courses.update');

Route::get('materias/{id}', [CoursesController::class, 'put'])->name('courses.index');
Route::put('materias/{id}', [CoursesController::class, 'change'])->name('courses.change');
Route::delete('materias/{id}', [CoursesController::class, 'delete'])->name('courses.delete');
