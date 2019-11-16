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

Route::middleware(['auth'])->group(function () {


    // ------------------------------- RUTAS DEL MODULO BIBLIOTECA ------------------------------//
    Route::middleware(['web', 'rol:1,2,3,4'])->group(function () {

        // Route::get('/biblioteca/busqueda/libro', 'HomeController@busquedaLibro')->name('buscar.disponible');
        Route::get('/biblioteca/imprimir/all', 'LibroController@AllTags')->name('imprimir.all');
        Route::get('/biblioteca/imprimir', 'LibroController@Tags')->name('imprimir');

        // Route::get('/biblioteca/prestamo', 'HomeController@prestamos')->name('prestamos');
        Route::resource('/biblioteca/prestamos', 'PrestamoController');
        // Route::get('biblioteca/mis/prestamos', 'PrestamoController@indexMisPrestamos')->name('index.misPrestamos');
        Route::get('bibioteca/lista/mis-prestamos', 'PrestamoController@listaMisPrestamos')->name('misPrestamos');



        Route::get('/biblioteca/prestamo/lista', 'PrestamosController@index')->name('prestamos');
        Route::get('biblioteca/mis/prestamos', 'PrestamosController@misPrestamos')->name('mis.prestamos');

        Route::get('biblioteca/realizar/prestamo', 'PrestamosController@realizarPrestamo')->name('realizar.prestamo');
        
        Route::POST('/solicitar/prestamo', 'PrestamosController@solicitarPrestamo')->name('solicitar.prestamo');
        Route::POST('/reservar/prestamo', 'PrestamosController@reservarPrestamo')->name('reservar.prestamo');
        Route::POST('/aprobar/prestamo', 'PrestamosController@aprobarPrestamo')->name('aprobar.prestamo');
        Route::POST('/finalizar/prestamo', 'PrestamosController@finalizarPrestamo')->name('finalizar.prestamo');
        Route::POST('/prorrogar/prestamo', 'PrestamosController@prorrogarPrestamo')->name('prorrogar.prestamo');
        Route::POST('/penalizar/prestamo', 'PrestamosController@penalizarPrestamo')->name('penalizar.prestamo');
        Route::POST('/cancelar/prestamo', 'PrestamosController@cancelarPrestamo')->name('cancelar.prestamo');

        Route::get('/biblioteca/penalizaciones', 'PenalizacionController@index')->name('penalizaciones.lista');
        Route::POST('/biblioteca/solventar/penalizacion', 'PenalizacionController@solventar')->name('solventar.penalizacion');

        Route::get('/ver/aporte/online/{aporte}', 'PrestamosController@verAporteOnLine')->name('ver.aporte.online');


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
        
        Route::get('/inventario/lista/ejemplares', 'HomeController@listaEjemplares')->name('lista.ejemplares');
        Route::resource('/ejemplars', 'EjemplarController');
        Route::get('/inventario/ingreso/libro', 'HomeController@busqueda')->name('busqueda');
        Route::resource('/Ejemplar', 'EjemplarController');
        Route::resource('/material', 'MaterialBibliotecarioController');
        Route::get('/administracion/roles', 'HomeController@roles')->name('roles');


        //------------------------Mis rutas (K) para las interacciones
        Route::get('/interacciones/{id}', 'ComentarioController@interacciones');
        Route::get('/interactue', 'ComentarioController@interactue');
        Route::post('/dislikeComentario/{id}', 'ComentarioController@interaccionDislike')->name('interaccion.dislike');

        Route::get('/interactue_prueba/{idA}/{idC}', 'ComentarioController@interactue_prueba');

        //MIs rutas (K) para comentarios sin VUE
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

        Route::resource('/comites', 'ComiteController');
        Route::post('/administracion/asignar/comite', 'UserController@asignarComite')->name('asignar.comite');
        Route::get('/administracion/asignar/comites/{id?}', 'ComiteController@asignarComiteIndex')->name('asignar.comites');

        Route::get('/administracion/calendario','HomeController@calendario')->name('calendario');
        Route::resource('/administracion/calendarios','CalendarioController');
    });

    // -----------------------------------------OTRAS RUTAS -------------------------------------//

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/PrimerSumarioSelect', 'PrimerSumarioController@primerSumarioSelect');
    Route::get('/SegundoSumarioSelect/{id}', 'segundoSumarioController@segundoSumarioSelect');
    Route::get('/TercerSumarioSelect/{id}', 'tercerSumarioController@tercerSumarioSelect');

    Route::post('/marcar/leidas', 'HomeController@marcarLeidas')->name('marcar.leidas');
    
    // ESTAS SON LAS MIAMA QUE ESTASN ACA ARRIBA O QUE PEX? 
    Route::get('/PrimerSumarioSelect', 'PrimerSumarioController@primerSumarioSelect');
    Route::get('/SegundoSumarioSelect/{id}', 'SegundoSumarioController@segundoSumarioSelect');
    Route::get('/TercerSumarioSelect/{id}', 'TercerSumarioController@tercerSumarioSelect');

    /*Rutas para select2 del formulario de ejemplar*/
    Route::get('/TipoEmpastadoSelect', 'Select2Controller@tipoEmpastadoSelect');
    Route::get('/TipoAdquisicionSelect', 'Select2Controller@tipoAdquisicionSelect');
    Route::get('/EstadoEjemplarSelect', 'Select2Controller@estadoEjemplarSelect');
    Route::get('/CatalogoMaterialSelect', 'Select2Controller@catalogoMaterialSelect');
    Route::get('/TipoPrestamoSelect', 'Select2Controller@tipoPrestamoSelect');

    /*RUTA para select de Area*/
    Route::get('/area', 'AreaController@areaSelect')->name('areas');
    /*RUTA para select de Area*/

    //No le pongo middleware porque lo necesito para mostrar nombres en distintas vistas
    Route::resource('/users', 'UserController');
    Route::get('/usuarios/para/asignacion/comite', 'UserController@obtenerUsuarios');



    // -----------------------------------------Catálogos-------------------------------------//

    Route::resource('/palabraProhibida', 'PalabraProhibidaController');
    Route::get('/catalogos/palabras-prohibidas', 'PalabraProhibidaController@palabraProhibida')->name('palabras.prohibidas');
    Route::get('/getPalabras', 'PalabraProhibidaController@getPalabras');

    // -----------------------------------------CONFIGURACIONES -------------------------------------//
    Route::get('catalogos/Configuracion', 'ConfiguracionController@index')->name('Configuracion');
    Route::post('/Configuracion/update', 'ConfiguracionController@update')->name('Configuracion.update');
    Route::resource('/Puntuaciones', 'PuntuacionesController');
    Route::resource('/Niveles', 'NivelesController');
    Route::get('catalogos/registro/actividad', 'RegistroActividadController@index')->name('registro.actividad');
    Route::get('catalogos/registro/actividad/descargar', 'RegistroActividadController@downloadTxt')->name('registro.actividad.descargar');

    // -----------------------------------------CONFIGURACIONES -------------------------------------//
    Route::get('graficos/aportes', 'GraficosController@index')->name('graficos.aportes');
    Route::get('graficos/aportes/anio', 'GraficosController@aportesAnio')->name('graficos.aportes.anio');

    // -----------------------------------------ERRORES RUTAS -------------------------------------//
    Route::get('/error/1', 'ErroresController@error1')->name('error1');
    
    // -----------------------------------------PERFIL DE USUARIO -------------------------------------//
    Route::get('/Usuario/totalAportesCreados/{id}', 'UserController@totalAportesCreados')->name('totalAportesCreados');
    Route::get('/aportesProfile', 'AporteController@aportesProfile');


});
