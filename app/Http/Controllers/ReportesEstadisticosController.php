<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use App\Libro;
use App\materialBibliotecario;
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
      $librosd=  Ejemplar::where('ID_ESTADO_EJEMPLAR',2) //CATALOGO ID_ESTADO_EJEMPLAR 2 es "MALO"
                    ->get();
                    activity()->log('Se genero el PDF libros mas dañados');

           return view('Reportes.librosDaniados')->with('librosd',$librosd)->render();
    }

    public function LibrosSinInventariar()
    {
      $librosSinInventariar=  materialBibliotecario::whereYear('FECHA_INVENTARIADO','<',now())
                    ->get();
                    activity()->log('Se genero el PDF libros sin inventariar');

           return view('Reportes.librosSinInventariar')->with('librosSinInventariar',$librosSinInventariar)->render();
    }
}
