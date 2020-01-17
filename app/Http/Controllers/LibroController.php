<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use App\Libro;
use App\Modelos\Ejemplar;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Muestra las etiquetas de todos
     *los libros, para imprimir
     */
    public function index(){
        $ejemplares = Ejemplar::all();

        return view('Etiquetas.Etiquetas')->with([
            'ejemplares'=> $ejemplares
        ]);
    }
    public function Alltags(Request $request)
    {
        //if($request->ajax()){
            $tags= DB::table('Ejemplar')
                    ->join('materialBibliotecario', 'Ejemplar.id', '=', 'materialBibliotecario.ID_EJEMPLAR')
                    ->select('Ejemplar.EJEMPLAR','materialBibliotecario.CODIGO_BARRA')
                    ->get();
                    activity()->log('Generó etiquetas');

           return view('Etiquetas.AllTags')->with('tags',$tags)->render();
             
            
            // $pdf = new Dompdf();
            //  $view =  \View::make("Etiquetas.AllTags", compact('tags'))->render();
            //  $pdf = \App::make('dompdf.wrapper');
            //  $pdf->loadHTML($view);        
            //  return $pdf->stream('reporte.pdf');
                   
        //}else{
          //  return view('home');
        //}  
    }
    public function TagsEjemplar($id){
        $tags= DB::table('Ejemplar')
        ->join('materialBibliotecario', 'Ejemplar.id', '=', 'materialBibliotecario.ID_EJEMPLAR')
        ->where('Ejemplar.id','=',$id)
        ->select('Ejemplar.EJEMPLAR','materialBibliotecario.CODIGO_BARRA')
        ->get();
        activity()->log('Generó etiquetas del ejemplar con ID'.$id);
        $pdf = new Dompdf();
        $view =  \View::make("Etiquetas.AllTags", compact('tags'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);        
        return $pdf->stream('reporte.pdf');
    }

    public function tejuelos(){

        $tejuelos = DB::table('Ejemplar')
        ->join('materialBibliotecario', 'Ejemplar.id', '=', 'materialBibliotecario.ID_EJEMPLAR')
        ->select('Ejemplar.ID_TERCER_SUMARIO','materialBibliotecario.id')
        ->get();
        return view('Etiquetas.Tejuelos')->with('tejuelos',$tejuelos)->render();

    }

    
}
