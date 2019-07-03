<?php

namespace App\Http\Controllers;

use App\Ejemplar;
use Illuminate\Http\Request;

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
        /*Ejemplar::create(
            $request->DESCRIPCION = Descripcion,
            $request->AUTOR = Autor,
            $request->EJEMPLAR= NOMBRE,
            $request->NUMERO_PAGINAS= Paginas,
            $request->ISBN = ISBN
        );*/
        $Ejemplar= new Ejemplar();

        $Ejemplar->DESCRIPCION= $request->DESCRIPCION;
        $Ejemplar->AUTOR= 'Autor de prueba me dice que intento convertir un array en string';
            $Ejemplar->NOMBRE = $request->EJEMPLAR;
            $Ejemplar->ISBN = $request->ISBN;
            $Ejemplar->PAGINAS= $request->NUMERO_PAGINAS;
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
