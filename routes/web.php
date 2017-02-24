<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::resource('/jabatan', 'JabatanController');
Route::resource('/golongan', 'GolonganController');
Route::resource('/pegawai', 'PegawaiController');
Route::resource('/kategori', 'KategorilemburController');
Route::resource('/lembur', 'LemburpegawaiController');
Route::resource('/tunjangan', 'TunjanganController');
Route::resource('/tunja', 'TunjanganpegawaiController');
Route::resource('/penggajian', 'PenggajianController');
Route::get('query', 'PenggajianController@search');