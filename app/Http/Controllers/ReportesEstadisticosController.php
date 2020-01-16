<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use App\Libro;
use App\Modelos\Ejemplar;

class ReportesEstadisticosController extends Controller
{
    public function UsuariosMasActivos(Request $request)
    {
        //if($request->ajax()){
            $users=  DB::select('SELECT * FROM "users" order by "PUNTOS" DESC FETCH FIRST 10 rows only');
                    activity()->log('Generó Usuarios mas activos');

           return view('Reportes.usuariosMasActivos')->with('users',$users)->render();
             
            
            /* $pdf = new Dompdf();
              $view =  \View::make("Reportes.usuariosMasActivos", compact('users'))->render();
            $pdf = \App::make('dompdf.wrapper');
              $pdf->loadHTML($view);        
              return $pdf->stream('UsuariosMasActivos.pdf');*/
                   
        //}else{
          //  return view('home');
        //}  
    }
}
