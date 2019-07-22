<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Dompdf\Dompdf;
use App\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Muestra las etiquetas de todos
     *los libros, para imprimir
     */
    public function Alltags(Request $request)
    {
        //if($request->ajax()){
            $tags= DB::table('Ejemplar')
                    ->join('Libro', 'Ejemplar.id', '=', 'Libro.ID_EJEMPLAR')
                    ->select('Ejemplar.EJEMPLAR','Libro.CODIGO_BARRA')
                    ->get();
                    return view('Etiquetas.AllTags')->with(['tags' => $tags]);
        //}else{
          //  return view('home');
        //}
        /*$pdf = new Dompdf;
         // $date = date('Y-m-d');
        $view =  \View::make("certificado.certificado1", compact('data', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        return $pdf->stream('reporte.pdf');*/
    }
    public function Tags(){
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit(Libro $libro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libro $libro)
    {
        //
    }
}
