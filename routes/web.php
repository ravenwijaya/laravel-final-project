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


Auth::routes();

Route::get('/', function () {
    // return view('item.index');
    return view('auth.login');
});
Route::group(['middleware'=>'auth'],function(){
//Route::get('/', 'HomeController@index')->name('home');
Route::get('/pertanyaan','pertanyaanController@index')->name('pertanyaan.index');
Route::get('/pertanyaan/create','pertanyaanController@create')->name('pertanyaan.create');
Route::post('/pertanyaanc','pertanyaanController@store');
// Route::post('/pertanyaanvu','pertanyaanController@pertanyaanvoteu');
// Route::post('/pertanyaanvd','pertanyaanController@pertanyaanvoted');
Route::get('/pertanyaan/{id}','pertanyaanController@show')->name('pertanyaan.show');
Route::get('/pertanyaan/{id}/edit','pertanyaanController@edit');
Route::put('/pertanyaan/{id}','pertanyaanController@update');
Route::delete('/pertanyaan/{id}','pertanyaanController@destroy');

Route::get('/jawaban/{id}','jawabanController@index')->name('jawaban.index');
Route::get('/jawaban/create/{id}','jawabanController@create');
Route::post('/jawaban/{id}','jawabanController@store')->name('jawaban.store');
// // Route::post('/pertanyaanvu','pertanyaanController@pertanyaanvoteu');
// Route::post('/pertanyaanvd','pertanyaanController@pertanyaanvoted');
// Route::get('/jawaban/{id}','jawabanController@show');
Route::get('/jawaban/{id}/edit','jawabanController@edit');
Route::put('/jawaban/{id}','jawabanController@update');
Route::delete('/jawaban/{id}','jawabanController@destroy');


Route::get('/komentar_pertanyaan/{id}', 'KomentarController@pertanyaan')->name('komentar.pertanyaan');
Route::post('/komentar_pertanyaan/{id}', 'KomentarController@store')->name('komentar.store');
Route::get('/komentar_jawaban/{id}', 'KomentarController@jawaban')->name('komentar.jawaban');
Route::post('/komentar_jawaban/{id}', 'KomentarController@store')->name('komentar.jawaban.store');

Route::get('/vote_pertanyaan_up/{id}', 'VoteController@pertanyaan_up')->name('votepertanyaan.up');
Route::get('/vote_pertanyaan_down/{id}', 'VoteController@pertanyaan_down')->name('votepertanyaan.down');
Route::get('/vote_jawaban_up/{id}', 'VoteController@jawaban_up')->name('votejawaban.up');
Route::get('/vote_jawaban_down/{id}', 'VoteController@jawaban_down')->name('votejawaban.down');

Route::get('/vote_jawaban_terbaik/{id}', 'VoteController@best_answer')->name('vote.best');


});