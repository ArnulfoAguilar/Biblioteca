<?php

namespace App\Http\Controllers;

use App\Configuracion;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configuraciones= Configuracion::first();
        return view('administracion.Configuraciones')
        ->with(['configuraciones' => $configuraciones]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Configuracion  $configuracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $configuracion= Configuracion::find($request->id);
        $request->diasHabiles != null ? $configuracion->DIAS_HABILES_PRORROGA=$request->diasHabiles : ''; 
        $request->diasProrroga != null ? $configuracion->DIAS_PRORROGABLES=$request->diasProrroga : ''; 
        $request->archivoSize!= null ? $configuracion->TAMAÑO_MAXIMO_ARCHIVOS=$request->archivoSize : '';
        $request->customSwitch3 == '' || $request->customSwitch3 == null ? $configuracion->HABILITAR_COMENTARIOS = false:$configuracion->HABILITAR_COMENTARIOS = true;
        $configuracion->Save();
        return redirect()->route('Configuracion');
    }

}
