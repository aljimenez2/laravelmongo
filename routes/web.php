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

Route::get('/', 'UserController@index');
Route::post('users/store', 'UserController@store');
Route::post('users/edit', 'UserController@edit');
Route::post('users/update', 'UserController@update');
Route::post('users/delete', 'UserController@destroy');
Route::post('save/order', 'UserController@saveOrder');
Route::get('updated/users/list', 'UserController@updateUserList');
Route::get('users/createInitial', 'UserController@createInitial');
Route::get('phpinfo', function(){
    return phpinfo();
});
