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

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->group(function() {
	Route::get('/', 'Admin\AdminController@index')->name('admin.dashboard');
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
	Route::get('/logs', 'Admin\AdminController@log')->name('admin.log');
	Route::prefix('/management')->group(function() {
		Route::prefix('/mahasiswa')->group(function() {
			Route::get('/', 'Admin\ManagementController@showDataMahasiswa')->name('admin.manage.mahasiswa');
			Route::post('/update', 'Admin\ManagementController@updateDataMahasiswa')->name('admin.manage.mahasiswa.update');
			Route::post('/create', 'Admin\ManagementController@createDataMahasiswa')->name('admin.manage.mahasiswa.create');
			Route::post('/delete', 'Admin\ManagementController@deleteDataMahasiswa')->name('admin.manage.mahasiswa.delete');
		});
		Route::prefix('/dosen')->group(function() {
			Route::get('/', 'Admin\ManagementController@showDataDosen')->name('admin.manage.dosen');
			Route::post('/update', 'Admin\ManagementController@updateDataDosen')->name('admin.manage.dosen.update');
			Route::post('/create', 'Admin\ManagementController@createDataDosen')->name('admin.manage.dosen.create');
			Route::post('/delete', 'Admin\ManagementController@deleteDataDosen')->name('admin.manage.dosen.delete');
		});
	});
	Route::prefix('/classroom')->group(function() {
		Route::get('/', 'Admin\ClassroomController@showClassroom')->name('admin.classroom');
		Route::post('/create', 'Admin\ClassroomController@createClassroom')->name('admin.classroom.create');
		Route::post('/update', 'Admin\ClassroomController@updateClassroom')->name('admin.classroom.update');
		Route::post('/delete', 'Admin\ClassroomController@deleteClassroom')->name('admin.classroom.delete');
	});
	Route::prefix('/course')->group(function() {
		Route::prefix('/dosen')->group(function() {
			Route::get('/', 'Admin\CourseController@showCourseDosen')->name('admin.course.dosen');
			Route::post('/create', 'Admin\CourseController@createCourseDosen')->name('admin.course.dosen.create');
			Route::post('/delete', 'Admin\CourseController@deleteCourseDosen')->name('admin.course.dosen.delete');
			Route::post('/update', 'Admin\CourseController@updateCourseDosen')->name('admin.course.dosen.update');
		});
	});
	Route::prefix('/schedule')->group(function(){
		Route::get('/', 'Admin\ScheduleController@showSchedule')->name('admin.schedule');
		Route::post('/create', 'Admin\ScheduleController@createSchedule')->name('admin.schedule.create');
		Route::post('/update', 'Admin\ScheduleController@updateSchedule')->name('admin.schedule.update');
		Route::post('/delete', 'Admin\ScheduleController@deleteSchedule')->name('admin.schedule.delete');
	});
});

Route::prefix('dosen')->group(function() {
	Route::get('/', 'Dosen\DosenController@index')->name('dosen.dashboard');
});

Route::prefix('mahasiswa')->group(function() {
	Route::get('/', 'Mahasiswa\MahasiswaController@index')->name('mahasiswa.dashboard');
});

Route::get('/home', 'HomeController@index')->name('home');
