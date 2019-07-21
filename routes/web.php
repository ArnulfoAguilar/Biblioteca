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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/Ejemplar','EjemplarController');
// Route::resource('/Ejemplar','EjemplarController');
Route::get('/PrimerSumarioSelect','primerSumarioController@primerSumarioSelect');
Route::get('/SegundoSumarioSelect/{id}','segundoSumarioController@segundoSumarioSelect');
Route::get('/TercerSumarioSelect/{id}','tercerSumarioController@tercerSumarioSelect');


