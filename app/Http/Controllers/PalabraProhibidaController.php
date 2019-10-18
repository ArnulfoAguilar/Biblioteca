<?php

namespace App\Http\Controllers;

use App\palabraProhibida;
use Illuminate\Http\Request;

class PalabraProhibidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function palabraProhibida(){
        return view('palabraProhibida.palabraProhibida');
    }

    /**
     * Getting a list of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getPalabras()
    {
        return palabraProhibida::all();
    }

    public function index()
    {
        $listapalabra = "";
        $palabraProhibida = palabraProhibida::all();
        $cantidadDePalabras=sizeof($palabraProhibida);
        $contador=1;
        foreach($palabraProhibida as $k => $palabra){
            if($contador<$cantidadDePalabras){
                $listapalabra.="^".$palabra->PALABRA."| ".$palabra->PALABRA." | ".$palabra->PALABRA."$|";
            }else{
                $listapalabra.="^".$palabra->PALABRA."| ".$palabra->PALABRA." | ".$palabra->PALABRA."$";
            }
            $contador++;
        }
        return $listapalabra;
    }

    // public function lista()
    // {
    //     $malasPalabras = [];
    //     $palabrasProhibidas = palabraProhibida::select('PALABRA')->get();
    //     foreach ($palabrasProhibidas as $key => $palabra) {
    //         $malasPalabras[] .= $palabra->PALABRA;
    //     }
    //     return $malasPalabras;
    // }

    public function lista()
    {
        $listapalabra = "";
        $palabraProhibida = palabraProhibida::all();
        $cantidadDePalabras=sizeof($palabraProhibida);
        $contador=1;
        foreach($palabraProhibida as $k => $palabra){
            if($contador<$cantidadDePalabras){
                $listapalabra.="^".$palabra->PALABRA."| ".$palabra->PALABRA." | ".$palabra->PALABRA."$|";
            }else{
                $listapalabra.="^".$palabra->PALABRA."| ".$palabra->PALABRA." | ".$palabra->PALABRA."$";
            }
            $contador++;
        }
        return $listapalabra;
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
        $palabraProhibida = new palabraProhibida();
        $palabraProhibida->PALABRA = $request->PALABRA;
        $palabraProhibida->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\palabraProhibida  $palabraProhibida
     * @return \Illuminate\Http\Response
     */
    public function show(palabraProhibida $palabraProhibida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\palabraProhibida  $palabraProhibida
     * @return \Illuminate\Http\Response
     */
    public function edit(palabraProhibida $palabraProhibida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\palabraProhibida  $palabraProhibida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $palabraProhibida = palabraProhibida::find($id);
        $palabraProhibida->PALABRA = $request->PALABRA;
        $palabraProhibida->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\palabraProhibida  $palabraProhibida
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $palabraProhibida = palabraProhibida::find($id);
        $palabraProhibida->delete();
    }
}
