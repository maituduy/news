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

Route::get('/', 'ClientController@home')->name('home');

Route::get('/login', 'User\AuthController@showLoginForm');
Route::post('/login', 'User\AuthController@login');
Route::get('/signup', 'User\AuthController@showSignupForm');
Route::post('/signup', 'User\AuthController@signup');
Route::get('/logout', 'User\AuthController@logout')->name('logout');

Route::get('/{slug}.{id}.htm', 'ClientController@category')->name('category');
Route::get('/tag/{slug}.{id}.htm', 'ClientController@tag')->name('tag');
Route::post('/ajax_like', 'ClientController@ajax_like');
Route::post('/comment/{id}', 'ClientController@comment')->name('comment');
Route::get('/{cate}/{slug}.{id}.htm', 'ClientController@story')->name('story');
Route::get('/search', 'ClientController@search');

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
    
    Route::get('/search', 'Admin\StoryController@search')->name('admin_search');
    Route::get('/stories/changestatus/{id}', 'Admin\StoryController@changeStatus')->name('stories.change');
    Route::resource('/stories', 'Admin\StoryController');
});
