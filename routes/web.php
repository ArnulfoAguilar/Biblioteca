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
Route::get('/biblioteca/imprimir', 'LibroController@Tags')->name('imprimir');

// ------------------------------- RUTAS DEL MODULO DE INVENTARIO----------------------------//

Route::get('/inventario/bibliotecas', 'BibliotecaController@biblioteca')->name('biblioteca');
Route::resource('/Biblioteca', 'BibliotecaController');

Route::get('/inventario/estantes', 'EstanteController@estante')->name('inventario.estantes');
Route::resource('/Estante', 'EstanteController');

Route::get('/inventario/lista/ejemplares', 'HomeController@listaEjemplares')->name('lista.ejemplares');
Route::resource('/ejemplars', 'EjemplarController');
Route::get('/inventario/ingreso/libro', 'HomeController@busqueda')->name('busqueda');
Route::resource('/Ejemplar', 'EjemplarController');
Route::get('/administracion/roles', 'HomeController@roles')->name('roles');

// ------------------------------- RUTAS DEL MODULO DE APORTES-------------------------------//

Route::resource('/aportes', 'AporteController');
Route::get('/aporte/obtener', 'AporteController@obtener')->name('obtener.aporte');
Route::get('/listaAportes', 'AporteController@lista')->name('aportes.lista');
Route::get('/listaTodosAportes', 'AporteController@listatodos')->name('aportes.lista.todos');
Route::resource('/revisiones', 'RevisionController');
Route::resource('/comentarios', 'ComentarioController');



// ------------------------------- RUTAS DEL MODULO DE ADQUISICIONES-------------------------//


// ---------------------------------RUTAS DEL MODULO DE ADMINISTRACION -------------------------------------//
Route::resource('/users', 'UserController');

Route::resource('/roles', 'RolController');
Route::post('/administracion/asignar/rol', 'UserController@asignarRol')->name('asignar.rol');

Route::get('/administracion/asignar/roles/{id?}', 'RolController@asignarRolIndex')->name('asignar.roles');


// -----------------------------------------OTRAS RUTAS -------------------------------------//

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/PrimerSumarioSelect', 'PrimerSumarioController@primerSumarioSelect');
Route::get('/SegundoSumarioSelect/{id}', 'SegundoSumarioController@segundoSumarioSelect');
Route::get('/TercerSumarioSelect/{id}', 'TercerSumarioController@tercerSumarioSelect');

/*Rutas para select2 del formulario de ejemplar*/
Route::get('/TipoEmpastadoSelect', 'Select2Controller@tipoEmpastadoSelect');
Route::get('/TipoAdquisicionSelect', 'Select2Controller@tipoAdquisicionSelect');
Route::get('/EstadoEjemplarSelect', 'Select2Controller@estadoEjemplarSelect');
Route::get('/CatalogoMaterialSelect', 'Select2Controller@catalogoMaterialSelect');

/*RUTA para select de Area*/
Route::get('/area', 'AreaController@areaSelect')->name('areas');
/*RUTA para select de Area*/
