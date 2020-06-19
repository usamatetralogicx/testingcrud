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

Route::get('/','CrudController@index2');
Route::get('create','CrudController@index');
Route::post('adduser','CrudController@save');
Route::post('delete/{id}','CrudController@delete');
Route::get('edit/{id}','CrudController@edit');
Route::post('update','CrudController@update');