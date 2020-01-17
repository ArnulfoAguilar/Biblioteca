<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use App\Libro;
use App\Modelos\Ejemplar;

class ReportesEstadisticosController extends Controller
{
    public function UsuariosMasActivos()
    {
            $users=  DB::select('SELECT * FROM "users" order by "PUNTOS" DESC FETCH FIRST 10 rows only');
                    activity()->log('Generó Usuarios mas activos');

           return view('Reportes.usuariosMasActivos')->with('users',$users)->render();
              
    }

    public function LibrosDaniados()
    {
      $librosdañados=  Ejemplar::where('ID_ESTADO_EJEMPLAR',2) //CATALOGO ID_ESTADO_EJEMPLAR 2 es "MALO"
                    ->get();
                    activity()->log('Se genero el PDF libros mas dañados');

           return view('Reportes.librosDaniados')->with('librosdaniados',$librosdañados)->render();
    }
}
