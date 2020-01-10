<?php

namespace App\Http\Controllers;

use App\Modelos\Ejemplar;
use App\Modelos\VwEjemplarSumarios;
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
        if ($request->ajax()) {
            return VwEjemplarSumarios::all();
        } else {
            return view('home');
        }
    }

    public function disponibles(Request $request)
    {
        if ($request->ajax()) {
            return Ejemplar::all();
        } else {
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
        if ($url != null) {
            $contents = file_get_contents($url);
            $file = '/bookImages/' . urlencode($request->EJEMPLAR) . ".png";
            Storage::put($file, $contents);
        }
        $Ejemplar = new Ejemplar();
        $Ejemplar->DESCRIPCION = $request->DESCRIPCION;
        $Ejemplar->AUTOR = $request->AUTOR;
        $Ejemplar->EJEMPLAR = $request->EJEMPLAR;
        $Ejemplar->ISBN = $request->ISBN;
        if ($url == null) {
            $Ejemplar->IMAGEN = '';
        } else {
            $Ejemplar->IMAGEN = $file;
        }
        $Ejemplar->ID_TERCER_SUMARIO = $request->TERCERSUMARIO;
        $Ejemplar->NUMERO_PAGINAS = $request->NUMERO_PAGINAS;
        $Ejemplar->NUMERO_COPIAS = $request->COPIAS;
        $Ejemplar->SUBTITULO = $request->SUBTITULO;
        $Ejemplar->EDITORIAL = $request->EDITORIAL;
        $Ejemplar->EDICION = $request->EDICION;
        $Ejemplar->AÑO_EDICION = $request->AÑO_EDICION;
        $Ejemplar->LUGAR_EDICION = $request->LUGAR_EDICION;
        $Ejemplar->OBSERVACIONES = $request->OBSERVACIONES;
        $Ejemplar->PALABRAS_CLAVE = $request->PALABRAS_CLAVE;
        $Ejemplar->ID_TERCER_SUMARIO = $request->TERCER_SUMARIO;
        $Ejemplar->ID_TIPO_EMPASTADO = $request->TIPO_EMPASTADO;
        $Ejemplar->ID_TIPO_ADQUISICION = $request->TIPO_ADQUISICION;
        $Ejemplar->ID_ESTADO_EJEMPLAR = $request->ESTADO_EJEMPLAR;
        $Ejemplar->ID_CATALOGO_MATERIAL = $request->CATALOGO_MATERIAL;
        $Ejemplar->ID_AREA = $request->AREA;
        $Ejemplar->PRECIO = $request->PRECIO;
        $Ejemplar->save();
        activity()->performedOn($Ejemplar)->log('Guardó ejemplar ('.$Ejemplar->EJEMPLAR.')');
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
        if ($url != null) {
            $contents = file_get_contents($url);
            $file = public_path().'/bookImages/' . urlencode($request->EJEMPLAR) . ".png";
            file_put_contents($file, $contents);
        }
        $Ejemplar = Ejemplar::find($ejemplar->id);
        $Ejemplar->DESCRIPCION = $request->DESCRIPCION;
        $Ejemplar->AUTOR = $request->AUTOR;
        $Ejemplar->EJEMPLAR = $request->EJEMPLAR;
        $Ejemplar->ISBN = $request->ISBN;
        if ($url == null) {
            $Ejemplar->IMAGEN = '';
        } else {
            $Ejemplar->IMAGEN = $file;
        }
        $Ejemplar->NUMERO_PAGINAS = $request->NUMERO_PAGINAS;
        $Ejemplar->NUMERO_COPIAS = $request->COPIAS;
        $Ejemplar->SUBTITULO = $request->SUBTITULO;
        $Ejemplar->EDITORIAL = $request->EDITORIAL;
        $Ejemplar->EDICION = $request->EDICION;
        $Ejemplar->AÑO_EDICION = $request->AÑO_EDICION;
        $Ejemplar->LUGAR_EDICION = $request->LUGAR_EDICION;
        $Ejemplar->OBSERVACIONES = $request->OBSERVACIONES;
        $Ejemplar->PALABRAS_CLAVE = $request->PALABRAS_CLAVE;
        $Ejemplar->ID_TERCER_SUMARIO = $request->TERCER_SUMARIO;
        $Ejemplar->ID_TIPO_EMPASTADO = $request->TIPO_EMPASTADO;
        $Ejemplar->ID_TIPO_ADQUISICION = $request->TIPO_ADQUISICION;
        $Ejemplar->ID_ESTADO_EJEMPLAR = $request->ESTADO_EJEMPLAR;
        $Ejemplar->ID_CATALOGO_MATERIAL = $request->CATALOGO_MATERIAL;
        $Ejemplar->ID_AREA = $request->AREA;
        $Ejemplar->PRECIO = $request->PRECIO;
        $Ejemplar->save();
        activity()->performedOn($Ejemplar)->log('Editó ejemplar ('.$Ejemplar->EJEMPLAR.')');
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
        activity()->log('Eliminó ejemplar');

    }
    public function comprobarISBN($ISBN){
        return Ejemplar::where('ISBN',$ISBN)->get();
    }
}
