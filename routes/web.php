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
Route::resource('/ejemplars','EjemplarController');
Route::get('/busqueda', 'HomeController@busqueda')->name('busqueda');
Route::get('/lista/ejemplares', 'HomeController@listaEjemplares')->name('lista.ejemplares');
 /* RUTAS PARA IMPRIMIR ETIQUETAS CON CODIGO DE BARRA*/
Route::get('/imprimir/all', 'LibroController@AllTags')->name('imprimir.all');
Route::get('/imprimir', 'LibroController@Tags')->name('imprimir');
/* FIN RUTAS PARA IMPRIMIR ETIQUETAS CON CODIGO DE BARRA*/

/*Rutas para el CRUD biblioteca*/ 
Route::get('/Bibliotecaliv', 'BibliotecaController@biblioteca')->name('biblioteca');
Route::resource('/Biblioteca','BibliotecaController');
/*Rutas para el CRUD biblioteca*/ 


