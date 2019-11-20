<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penalizacion;
use App\Modelos\Prestamo;
use App\materialBibliotecario;

class PenalizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penalizaciones = Penalizacion::paginate(10);
        return view('Penalizacion.penalizaciones')->with([
            'penalizaciones'=> $penalizaciones,
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function solventar(Request $request)
    {
        $penalizacion = Penalizacion::find($request->id);
        $penalizacion->SOLVENTADA = true;
        $penalizacion->save();

        $prestamo = Prestamo::find($penalizacion->ID_PRESTAMO);
        $prestamo->ID_ESTADO_PRESTAMO = 5;
        $prestamo->FECHA_DEVOLUCION = date('Ymd H:i:s');
        $prestamo->save();
       
        // $material = materialBibliotecario::find($prestamo->ID_MATERIAL);
        // $material->DISPONIBLE = true;
        // $material->save();
        foreach ($prestamo->materiales as $key => $material) {
            $material->DISPONIBLE = true;
            $material->save();
        }

        activity()->performedOn($penalizacion)->log('Solventó penalización ('.$penalizacion->id.') ');
    
    }
}
