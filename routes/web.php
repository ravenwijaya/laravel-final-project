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
    return view('item.index');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/pertanyaan','pertanyaanController@index')->name('pertanyaan.index');
Route::get('/pertanyaan/create','pertanyaanController@create');
Route::post('/pertanyaanc','pertanyaanController@store');
Route::post('/pertanyaanvu','pertanyaanController@pertanyaanvoteu');
Route::post('/pertanyaanvd','pertanyaanController@pertanyaanvoted');
Route::get('/pertanyaan/{id}','pertanyaanController@show');
Route::get('/pertanyaan/{id}/edit','pertanyaanController@edit');
Route::put('/pertanyaan/{id}','pertanyaanController@update');
Route::delete('/pertanyaan/{id}','pertanyaanController@destroy');

