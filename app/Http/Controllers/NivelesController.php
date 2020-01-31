<?php

namespace App\Http\Controllers;

use App\Niveles;
use Illuminate\Http\Request;

class NivelesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Nivel()
    {
        return view('administracion.Niveles');
    }
    public function index()
    {
        $niveles= Niveles::all();
        return $niveles;
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
        $NIVEL = new Niveles();
        $NIVEL->NIVEL = $request->NIVEL;
        $NIVEL->PUNTAJE_MINIMO = $request->PUNTAJE_MINIMO;
        $NIVEL->BADGE = $request->BADGE;
        $NIVEL->save();
        activity()->log('NIVEL guardada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Niveles  $niveles
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        
        return $NIVEL = Niveles::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Niveles  $niveles
     * @return \Illuminate\Http\Response
     */
    public function edit(Niveles $niveles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Niveles  $niveles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Niveles $niveles,$id)
    {
        $NIVEL = Niveles::find($id);
        $NIVEL->NIVEL = $request->NIVEL;
        $NIVEL->PUNTAJE_MINIMO = $request->PUNTAJE_MINIMO;
        $NIVEL->BADGE = $request->BADGE;
        $NIVEL->save();
        activity()->log('NIVEL Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Niveles  $niveles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $NIVEL = Niveles::find($id);
        $NIVEL->destroy();
        activity()->log('Nivel eliminada');
    }
}
