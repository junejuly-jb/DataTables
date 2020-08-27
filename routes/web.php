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

// Route::resource('students', 'MyController');
Route::get('/index', 'DatatablesController@index')->name('home');
Route::get('students', 'DatatablesController@getUsers')->name('get.users');
Route::get('/students/{id}/edit', 'DatatablesController@edit')->name('student.edit');
Route::post('/students/add', 'DatatablesController@store')->name('student.add');
Route::delete('/students/delete/{id}', 'DatatablesController@delete')->name('student.delete');
