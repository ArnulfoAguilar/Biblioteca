<?php

namespace App\Http\Controllers;

use App\Puntuaciones;
use Illuminate\Http\Request;

class PuntuacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $puntuaciones= Puntuaciones::first();
        return view('administracion.Puntuaciones')
        ->with(['puntuaciones' => $puntuaciones]);
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
     * @param  \App\Puntuaciones  $puntuaciones
     * @return \Illuminate\Http\Response
     */
    public function show(Puntuaciones $puntuaciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Puntuaciones  $puntuaciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Puntuaciones $puntuaciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Puntuaciones  $puntuaciones
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puntuaciones $puntuaciones)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Puntuaciones  $puntuaciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puntuaciones $puntuaciones)
    {
        //
    }
}
