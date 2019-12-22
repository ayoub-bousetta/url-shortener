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
Route::get('/logout','Auth\LoginController@logout')->name('logout');

Route::get('/{code?}','urlController@redirecturl')->name('redirecturl')->where(['code' => '[a-zA-Z0-9]{6}']);

Route::get('/url/{code?}','urlController@index')->name('index');
Route::post('/url','urlController@storeit')->name('sendit');

Route::get('/url/edit/{code}','urlController@editurl')->name('getitToedit');
Route::post('/url/edit/{code}','urlController@editurl')->name('editit');
Route::delete('/url/delete/{code}','urlController@delete')->name('deleteit');






Route::get('/getallurl','urlController@getallurl')->name('alluserurl');

