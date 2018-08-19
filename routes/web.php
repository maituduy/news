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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/admin')->group(function () {
    Route::get('/', 'Admin\AuthController@showLoginForm');
    Route::post('/', 'Admin\AuthController@login');
    Route::get('/logout', 'Admin\AuthController@logout')->name('admin_logout');
    Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('admin_dashboard');

    Route::post('/users/destroymany', 'Admin\UserController@destroyMany')->name('users.destroymany');
    Route::get('/users/changestatus/{id}', 'Admin\UserController@changeStatus')->name('users.change');
    Route::resource('/users', 'Admin\UserController');

    Route::get('/categories', 'Admin\CategoryController@index')->name('categories.index');
    Route::post('/createcategory', 'Admin\CategoryController@ajax')->name('cateajax');

    Route::post('/employees/destroymany', 'Admin\EmployeeController@destroyMany')->name('employees.destroymany');
    Route::resource('employees', 'Admin\EmployeeController');
    
    Route::resource('/stories', 'Admin\StoryController');
});
