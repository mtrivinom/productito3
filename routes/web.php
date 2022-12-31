<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\Index_Controller::class, 'index'])->name('home');

Route::get('notifications', [App\Http\Controllers\Notifications_Coontroller::class, 'index'])->name('notifications.index');
Route::patch('notifications/{id}', [App\Http\Controllers\Notifications_Coontroller::class, 'read'])->name('notifications.read');
Route::delete('notifications/{id}', [App\Http\Controllers\Notifications_Coontroller::class, 'destroy'])->name('notifications.destroy');

Route::resource('courses', Courses_Controller::class);
Route::resource('classes', App\Http\Controllers\Classes_Controller::class);

Route::resource('user', User_Controller::class);
Route::resource('admins', App\Http\Controllers\Admins_Controller::class);
Route::resource('students', App\Http\Controllers\Students_Controller::class);
Route::resource('teachers', App\Http\Controllers\Teachers_Controller::class);

Route::resource('enrollments', App\Http\Controllers\Enrollment_Controller::class);
Route::resource('schedules', App\Http\Controllers\Schedule_Controller::class);

Route::resource('works', App\Http\Controllers\Works_Controller::class);
Route::resource('exams', App\Http\Controllers\Exams_Controller::class);
Route::resource('percentage', App\Http\Controllers\Percentage_Controller::class);
