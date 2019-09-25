<?php

namespace App\Http\Controllers;

use App\Adquisicion;

use Illuminate\Http\Request;


class AdquisicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Adquisicion::orderBy('created_at','desc')->get();
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
        try {
            $sugerencia = new Adquisicion();
            $sugerencia->TITULO = $request->TITULO;
            $sugerencia->DESCRIPCION = $request->DESCRIPCION;
            $sugerencia->CONTENIDO = $request->CONTENIDO;
            $sugerencia->ID_AREA = $request->ID_AREA;
            $sugerencia->ID_USUARIO = auth()->id();
            $sugerencia->save();
            // return 'Se supone que si guarda cerote'
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $sugerencia = Adquisicion::find($id);
            $sugerencia->TITULO = $request->TITULO;
            $sugerencia->DESCRIPCION = $request->DESCRIPCION;
            $sugerencia->CONTENIDO = $request->CONTENIDO;
            $sugerencia->ID_AREA = $request->ID_AREA;
            $sugerencia->ID_USUARIO = auth()->id();
            $sugerencia->save();
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sugerencia = Adquisicion::find($id);
        $sugerencia->delete();
    }
}
