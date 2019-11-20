<?php

namespace App\Http\Controllers;

use App\tipoPenalizacion;
use App\Area;
use App\User;
use Illuminate\Http\Request;

class TipoPenalizacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
            return tipoPenalizacion::all();
        }else{
            return view('home');
        }
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

        $tipoPenalizacion = new tipoPenalizacion();
        $tipoPenalizacion->TIPO_PENALIZACION = $request->TIPO_PENALIZACION;
        $tipoPenalizacion->Save();

        activity()->performedOn($tipoPenalizacion)->log('Guardó comite ('.$tipoPenalizacion->TIPO_PENALIZACION.')');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tipoPenalizacion  $comite
     * @return \Illuminate\Http\Response
     */
    public function show(tipoPenalizacion $comite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tipoPenalizacion  $comite
     * @return \Illuminate\Http\Response
     */
    public function edit(tipoPenalizacion $comite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tipoPenalizacion  $comite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tipoPenalizacion $comite)
    {
        //
        $tipoPenalizacion = tipoPenalizacion::find($request->id);
        $tipoPenalizacion->TIPO_PENALIZACION = $request->TIPO_PENALIZACION;
        $tipoPenalizacion->save();
        activity()->performedOn($tipoPenalizacion)->log('Actualizó comite ('.$tipoPenalizacion->TIPO_PENALIZACION.')');
        return $tipoPenalizacion;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tipoPenalizacion  $comite
     * @return \Illuminate\Http\Response
     */
    public function destroy($penalizacion)
    {
        if($penalizacion != null){
            $tipoPenalizacion = tipoPenalizacion::find($penalizacion);
            $tipoPenalizacion->delete();
            activity()->performedOn($tipoPenalizacion)->log('Eliminó tipo penalizacion ('.$tipoPenalizacion->TIPO_PENALIZACION.')');
        }
        
    }

   
    
}
