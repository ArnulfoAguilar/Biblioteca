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
})->name('welcome');

Auth::routes();

// ------------------------------- RUTAS DEL MODULO BIBLIOTECA ------------------------------//
Route::middleware(['web', 'rol:1,2,3,4'])->group(function () {

    Route::get('/biblioteca/busqueda/libro', 'HomeController@busquedaLibro')->name('buscar.disponible');
    Route::get('/biblioteca/imprimir/all', 'LibroController@AllTags')->name('imprimir.all');
    Route::get('/biblioteca/imprimir', 'LibroController@Tags')->name('imprimir');

});

// ------------------------------- RUTAS DEL MODULO DE INVENTARIO----------------------------//
Route::middleware(['web', 'rol:1,2,3,4'])->group(function () {


    Route::get('/inventario/bibliotecas', 'BibliotecaController@biblioteca')->name('biblioteca');
    Route::resource('/Biblioteca', 'BibliotecaController');

    Route::get('/inventario/estantes', 'EstanteController@estante')->name('inventario.estantes');
    Route::resource('/Estante', 'EstanteController');

    Route::get('/inventario/lista/ejemplares', 'HomeController@listaEjemplares')->name('lista.ejemplares');
    Route::resource('/ejemplars', 'EjemplarController');
    Route::get('/inventario/ingreso/libro', 'HomeController@busqueda')->name('busqueda');
    Route::resource('/Ejemplar', 'EjemplarController');
    Route::get('/administracion/roles', 'HomeController@roles')->name('roles');

});

// ------------------------------- RUTAS DEL MODULO DE APORTES-------------------------------//
Route::middleware(['web', 'rol:1,2,3,4'])->group(function () {

    Route::resource('/aportes', 'AporteController');
    Route::get('/aporte/obtener', 'AporteController@obtener')->name('obtener.aporte');
    Route::get('/listaAportes', 'AporteController@lista')->name('aportes.lista');

    Route::get('/aporte/habilitar', 'AporteController@habilitar')->name('aportes.habilitar');

    Route::get('/listaAportesDirector', 'AporteController@listaDirector')->name('aportes.lista.director');
    Route::get('/listaTodosAportes', 'AporteController@listatodos')->name('aportes.lista.todos');
    Route::resource('/revisiones','RevisionController');
    Route::resource('/comentarios','ComentarioController');

    Route::get('comentariostodos', 'ComentarioController@todos')->name('comentarios.todos');
    Route::get('/comentario/habilitar', 'ComentarioController@habilitar')->name('comentarios.habilitar');

    Route::post('/likeComentario', 'ComentarioController@interaccionLike')->name('interaccion.like');
    Route::post('/reportComentario', 'ComentarioController@interaccionReport')->name('interaccion.report');
    Route::get('/interaccionesComentario/{id}', 'ComentarioController@interaccionesComentario')->name('interaccion.report');
    Route::resource('/palabraProhibida', 'PalabraProhibidaController');
    Route::get('/palabras-prohibidas','PalabraProhibidaController@palabraProhibida');

    //------------------------Mis rutas para las interacciones
    Route::get('/interacciones/{id}', 'ComentarioController@interacciones');
    Route::get('/interactue', 'ComentarioController@interactue');
    Route::post('/dislikeComentario/{id}', 'ComentarioController@interaccionDislike')->name('interaccion.dislike');

    Route::get('/interactue_prueba/{idA}/{idC}', 'ComentarioController@interactue_prueba');

    //MIs rutas para comentarios sin VUE
    Route::post('/darLike', 'ComentarioController@darLike')->name('dar.like');
    Route::post('/darDislike', 'ComentarioController@darDislike')->name('dar.dislike');
    Route::post('/guadarComentario', 'ComentarioController@guardarComentario')->name('guardar.comentario');
    Route::post('/listaMalasPalabras', 'PalabraProhibidaController@lista')->name('lista.malas.palabras');

});


// ------------------------------- RUTAS DEL MODULO DE ADQUISICIONES-------------------------//
Route::middleware(['web', 'rol:1,4'])->group(function () {
    Route::resource('/adquisiciones','AdquisicionController');
    Route::get('/adquisicion/lista', 'HomeController@adquisiciones')->name('adquisicion.lista');
});

// ---------------------------------RUTAS DEL MODULO DE ADMINISTRACION -------------------------------------//

Route::middleware(['web', 'rol:1'])->group(function () {
    Route::resource('/roles', 'RolController');
    Route::post('/administracion/asignar/rol', 'UserController@asignarRol')->name('asignar.rol');
    Route::get('/administracion/asignar/roles/{id?}', 'RolController@asignarRolIndex')->name('asignar.roles');
});

// -----------------------------------------OTRAS RUTAS -------------------------------------//

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/PrimerSumarioSelect', 'PrimerSumarioController@primerSumarioSelect');
Route::get('/SegundoSumarioSelect/{id}', 'segundoSumarioController@segundoSumarioSelect');
Route::get('/TercerSumarioSelect/{id}', 'tercerSumarioController@tercerSumarioSelect');

Route::post('/marcar/leidas', 'HomeController@marcarLeidas')->name('marcar.leidas');

/*RUTA para select de Area*/
Route::get('/area', 'AreaController@areaSelect')->name('areas');
/*RUTA para select de Area*/

//No le pongo middleware porque lo necesito para mostrar nombres en distintas vistas
Route::resource('/users', 'UserController');


// -----------------------------------------Catálogos-------------------------------------//

Route::resource('/palabraProhibida', 'PalabraProhibidaController');
Route::get('/catalogos/palabras-prohibidas', 'PalabraProhibidaController@palabraProhibida')->name('palabras.prohibidas');
Route::get('/getPalabras', 'PalabraProhibidaController@getPalabras');

// -----------------------------------------CONFIGURACIONES -------------------------------------//
Route::get('/Configuracion', 'ConfiguracionController@index')->name('Configuracion');
Route::post('/Configuracion/update', 'ConfiguracionController@update')->name('Configuracion.update');
// -----------------------------------------ERRORES RUTAS -------------------------------------//

Route::get('/error/1', 'ErroresController@error1')->name('error1');

