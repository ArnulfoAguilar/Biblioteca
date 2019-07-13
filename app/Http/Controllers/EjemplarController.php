<?php

namespace App\Http\Controllers;

use App\Ejemplar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EjemplarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $url = $request->IMAGEN;
        $contents = file_get_contents($url);
        $file = '/bookImages/'.urlencode($request->EJEMPLAR).".png";
        Storage::put($file, $contents);

        $Ejemplar= new Ejemplar();
        $Ejemplar->DESCRIPCION = $request->DESCRIPCION;
        $Ejemplar->AUTOR = 'Autor de prueba me dice que intento convertir un array en string';
        $Ejemplar->EJEMPLAR = $request->EJEMPLAR;
        $Ejemplar->ISBN = $request->ISBN;
        $Ejemplar->IMAGEN = $file;
        $Ejemplar->NUMERO_PAGINAS = $request->NUMERO_PAGINAS;
        $Ejemplar->NUMERO_COPIAS = $request->COPIAS;

        $Ejemplar->save();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ejemplar  $ejemplar
     * @return \Illuminate\Http\Response
     */
    public function show(Ejemplar $ejemplar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ejemplar  $ejemplar
     * @return \Illuminate\Http\Response
     */
    public function edit(Ejemplar $ejemplar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ejemplar  $ejemplar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ejemplar $ejemplar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ejemplar  $ejemplar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ejemplar $ejemplar)
    {
        //
    }
}
