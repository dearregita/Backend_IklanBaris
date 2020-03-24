<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::get('/book/{limit}/{offset}', 'BookController@getAll');

Route::middleware(['jwt.verify'])->group(function(){
    Route::get('user', 'UserController@getAll');

    //barang iklan
	Route::get('barang', "BarangController@index"); //read pelanggaran
	// Route::get('barang/{limit}/{offset}', "PelanggaranController@getAll"); read pelanggaran
	Route::post('barang', 'BarangController@store'); //create pelanggaran
	Route::put('barang/{id}', "BarangController@update"); //update pelanggaran
	Route::delete('barang/{id}', "BarangController@delete"); //delete pelanggaran
});