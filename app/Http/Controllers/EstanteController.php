<?php

namespace App\Http\Controllers;

use App\Estante;
use Illuminate\Http\Request;

class EstanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $estante = Estante::where('ID_BIBLIOTECA', $request->id)->get();
        return $estante;
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
        $estante = new Estante();
        $estante->ESTANTE = $request->identificador;
        $estante->CLASIFICACION = $request->clasificacion;
        $estante->ID_BIBLIOTECA = $request->biblioteca;
        $estante->save();
        return $estante;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function show(Estante $estante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estante $estante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $estante = Estante::find($id);
        $estante->ESTANTE = $request->identificador;
        $estante->CLASIFICACION = $request->clasificacion;
        $estante->save();

        return $estante;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estante = Estante::find($id);
        $estante->delete();
    }
}
