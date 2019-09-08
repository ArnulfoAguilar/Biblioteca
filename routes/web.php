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

// ------------------------------- RUTAS DEL MODULO BIBLIOTECA ------------------------------//

Route::get('/biblioteca/busqueda/libro', 'HomeController@busquedaLibro')->name('buscar.disponible');
Route::get('/biblioteca/imprimir/all', 'LibroController@AllTags')->name('imprimir.all');
Route::get('/bublioteca/imprimir', 'LibroController@Tags')->name('imprimir');

// ------------------------------- RUTAS DEL MODULO DE INVENTARIO----------------------------//

Route::get('/inventario/bibliotecas', 'BibliotecaController@biblioteca')->name('biblioteca');
Route::resource('/Estante', 'EstanteController');
Route::resource('/Biblioteca', 'BibliotecaController');
Route::get('/inventario/lista/ejemplares', 'HomeController@listaEjemplares')->name('lista.ejemplares');
Route::resource('/ejemplars', 'EjemplarController');
Route::get('/inventario/ingreso/libro', 'HomeController@busqueda')->name('busqueda');
Route::resource('/Ejemplar', 'EjemplarController');

// ------------------------------- RUTAS DEL MODULO DE APORTES-------------------------------//

Route::resource('/aportes', 'AporteController');
Route::resource('/revisiones', 'RevisionController');


// ------------------------------- RUTAS DEL MODULO DE ADQUISICIONES-------------------------//

// -----------------------------------------OTRAS RUTAS -------------------------------------//

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/PrimerSumarioSelect', 'PrimerSumarioController@primerSumarioSelect');
Route::get('/SegundoSumarioSelect/{id}', 'segundoSumarioController@segundoSumarioSelect');
Route::get('/TercerSumarioSelect/{id}', 'tercerSumarioController@tercerSumarioSelect');

/*RUTA para select de Area*/
Route::get('/area', 'AreaController@areaSelect')->name('areas');
/*RUTA para select de Area*/
