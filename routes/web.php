<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\SelectCourseController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // return view('auth.registration');
    return view('auth.login');
});

Route::get('registration', [CustomAuthController::class, 'registration'])->name('register');

Route::post('custom-registration', [CustomAuthController::class, 'custom_registration'])->name('register.custom');

Route::get('login', [CustomAuthController::class, 'index'])->name('login');

Route::post('custom-login', [CustomAuthController::class, 'custom_login'])->name('login.custom');

Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');

Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');


Route::get('profile', [ProfileController::class, 'index'])->name('profile');

Route::post('profile/edit_validation', [ProfileController::class, 'edit_validation'])->name('profile.edit_validation');


Route::get('teachers', [TeachersController::class, 'index'])->name('teachers');

Route::get('teachers/fetchall', [TeachersController::class, 'fetch_all'])->name('teachers.fetchall');

Route::get('teachers/add', [TeachersController::class, 'add'])->name('teachers.add');

Route::post('teachers/getdistrict', [TeachersController::class, 'getdistrict'])->name('teachers.getdistrict');

Route::post('teachers/add_validation', [TeachersController::class, 'add_validation'])->name('teachers.add_validation');

Route::get('teachers/edit/{id}', [TeachersController::class, 'edit'])->name('edit');

Route::post('teachers/edit_validation', [TeachersController::class, 'edit_validation'])->name('teachers.edit_validation');

Route::get('teachers/delete/{id}', [TeachersController::class, 'delete'])->name('delete');


Route::get('province', [ProvinceController::class, 'index'])->name('province');

Route::get('province/fetchall', [ProvinceController::class, 'fetchall'])->name('province.fetchall');

Route::get('province/add', [ProvinceController::class, 'add'])->name('province.add');

Route::post('province/add_validation', [ProvinceController::class, 'add_validation'])->name('province.add_validation');

Route::get('province/edit/{id}', [ProvinceController::class, 'edit'])->name('edit');

Route::post('province/edit_validation', [ProvinceController::class, 'edit_validation'])->name('province.edit_validation');

Route::get('province/delete/{id}', [ProvinceController::class, 'delete'])->name('delete');


Route::get('course', [CourseController::class, 'index'])->name('course');

Route::get('course/fetch_all', [CourseController::class, 'fetch_all'])->name('course.fetch_all');

Route::get('course/add', [CourseController::class, 'add'])->name('course.add');

Route::post('course/add_validation', [CourseController::class, 'add_validation'])->name('course.add_validation');

Route::get('course/edit/{id}', [CourseController::class, 'edit'])->name('edit');

Route::post('course/edit_validation', [CourseController::class, 'edit_validation'])->name('course.edit_validation');

Route::get('course/delete/{id}', [CourseController::class, 'delete'])->name('delete');


Route::get('students', [StudentsController::class, 'index'])->name('students');

Route::get('students/fetchall', [StudentsController::class, 'fetch_all'])->name('students.fetchall');

Route::get('students/add', [StudentsController::class, 'add'])->name('students.add');

Route::post('students/getdistrict', [StudentsController::class, 'getdistrict'])->name('students.getdistrict');

Route::post('students/add_validation', [StudentsController::class, 'add_validation'])->name('students.add_validation');

Route::get('students/edit/{id}', [StudentsController::class, 'edit'])->name('edit');

Route::post('students/edit_validation', [StudentsController::class, 'edit_validation'])->name('students.edit_validation');

Route::get('students/delete/{id}', [StudentsController::class, 'delete'])->name('delete');


Route::get('select_course', [SelectCourseController::class, 'index'])->name('select_course');

Route::get('select_course/fetch_all', [SelectCourseController::class, 'fetch_all'])->name('select_course.fetch_all');

Route::get('select_course/add', [SelectCourseController::class, 'add'])->name('select_course.add');

Route::post('select_course/getsubject', [SelectCourseController::class, 'getsubject'])->name('select_course.getsubject');

Route::post('select_course/add_validation', [SelectCourseController::class, 'add_validation'])->name('select_course.add_validation');

Route::get('select_course/edit/{id}', [SelectCourseController::class, 'edit'])->name('edit');

Route::post('select_course/edit_validation', [SelectCourseController::class, 'edit_validation'])->name('select_course.edit_validation');


Route::get('dash',[DashboardController::class, 'index'])->name('dash');
