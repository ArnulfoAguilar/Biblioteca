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
    public function index(Request $request)
    {
        if($request->ajax()){
            return Ejemplar::all();
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
        $url = $request->IMAGEN;
        if($url != null){
            $contents = file_get_contents($url);
            $file = '/bookImages/'.urlencode($request->EJEMPLAR).".png";
            Storage::put($file, $contents);
        }
        $Ejemplar= new Ejemplar();
        $Ejemplar->DESCRIPCION = $request->DESCRIPCION;
        $Ejemplar->AUTOR = $request->AUTOR;
        $Ejemplar->EJEMPLAR = $request->EJEMPLAR;
        $Ejemplar->ISBN = $request->ISBN;
        if($url == null){
            $Ejemplar->IMAGEN = '';

        }else {

            $Ejemplar->IMAGEN = $file;
        }
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
        $url = $request->IMAGEN;
        if($url != null){
            $contents = file_get_contents($url);
            $file = '/bookImages/'.urlencode($request->EJEMPLAR).".png";
            Storage::put($file, $contents);
        }
        $Ejemplar= Ejemplar::find($ejemplar->id);
        $Ejemplar->DESCRIPCION = $request->DESCRIPCION;
        $Ejemplar->AUTOR = $request->AUTOR;
        $Ejemplar->EJEMPLAR = $request->EJEMPLAR;
        $Ejemplar->ISBN = $request->ISBN;
        if($url == null){
            $Ejemplar->IMAGEN = '';
        }else{
            $Ejemplar->IMAGEN = $file;
        }
        $Ejemplar->NUMERO_PAGINAS = $request->NUMERO_PAGINAS;
        $Ejemplar->NUMERO_COPIAS = $request->COPIAS;
        $Ejemplar->save();
        return $Ejemplar;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ejemplar  $ejemplar
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Request $request)
    public function destroy(Ejemplar $ejemplar)
    {
        $Ejemplar = Ejemplar::find($ejemplar->id);
        $Ejemplar->delete();
    }
}
