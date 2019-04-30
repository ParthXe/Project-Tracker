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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/approval', 'HomeController@approval')->name('approval');

//project upload routes

Route::get('/project_list', 'ProjectController@projects')->name('projects');
Route::get('/create_project', 'ProjectController@create')->name('create');
Route::post('/submit_project', 'ProjectController@save_data')->name('save_data');
Route::get('/show_project/{id}', 'ProjectController@show')->name('show');
Route::get('/edit_project/{id}', 'ProjectController@edit')->name('edit');
Route::post('/update_project/{id}', 'ProjectController@update')->name('update');
Route::get('/delete_project/{id}', 'ProjectController@destroy')->name('destroy');

//task upload routes

Route::get('/task_list', 'TaskController@task')->name('task');
Route::get('/create_task', 'TaskController@create')->name('create');
Route::post('/submit_task', 'TaskController@save_data')->name('save_data');
Route::get('/show_task/{id}', 'TaskController@show')->name('show');
Route::get('/edit_task/{id}', 'TaskController@edit')->name('edit');
Route::post('/update_task/{id}', 'TaskController@update')->name('update');
Route::get('/delete_task/{id}', 'TaskController@destroy')->name('destroy');


Route::middleware(['auth'])->group(function () {
    Route::get('/approval', 'HomeController@approval')->name('approval');

    Route::middleware(['approved'])->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
    });

    Route::middleware(['admin'])->group(function () {
       Route::get('/users', 'UserController@index')->name('admin.users.index');
       Route::get('/users/{user_id}/approve', 'UserController@approve')->name('admin.users.approve');

    });

    
});
