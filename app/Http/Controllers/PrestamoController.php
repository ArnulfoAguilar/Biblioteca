<?php

namespace App\Http\Controllers;

use App\Modelos\VwPrestamo;
use App\Modelos\Prestamo;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VwPrestamo::all();
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
        $prestamo = new Prestamo();
        $prestamo->FECHA_PRESTAMO = $request->FECHA_PRESTAMO;
        $prestamo->ID_USUARIO = auth()->id();
        if(!empty($request->ID_TIPO_PRESTAMO))$prestamo->ID_TIPO_PRESTAMO = $request->ID_TIPO_PRESTAMO;
        if(!empty($request->FECHA_DEVOLUCION))$prestamo->FECHA_DEVOLUCION = $request->FECHA_DEVOLUCION;
        $prestamo->ID_ESTADO_PRESTAMO = $request->ID_ESTADO_PRESTAMO;
        $prestamo->ID_MATERIAL = $request->ID_MATERIAL;
        $prestamo->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modelos\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function show(Prestamo $prestamo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Modelos\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function edit(Prestamo $prestamo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Modelos\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prestamo $prestamo)
    {
        $prestamo = Prestamo::find($prestamo->id);
        $prestamo->FECHA_PRESTAMO = $request->FECHA_PRESTAMO;
        $prestamo->FECHA_DEVOLUCION = $request->FECHA_DEVOLUCION;
        $prestamo->ID_USUARIO = auth()->id();
        $prestamo->ID_TIPO_PRESTAMO = $request->ID_TIPO_PRESTAMO;
        $prestamo->ID_ESTADO_PRESTAMO = $request->ID_ESTADO_PRESTAMO;
        $prestamo->ID_MATERIAL = $request->ID_MATERIAL;
        $prestamo->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modelos\Prestamo  $prestamo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestamo $prestamo)
    {
        $Prestamo = Prestamo::find($prestamo->id);
        $Prestamo->delete();
    }

    public function indexMisPrestamos()
    {
        return view('Prestamo.listaMisPrestamos');
    }

    public function listaMisPrestamos(Request $request)
    {
        if ($request->ajax()) {
            $query = Prestamo::Where('ID_USUARIO', auth()->id())
                ->leftJoin('tipoPrestamo AS tp', 'Prestamo.ID_TIPO_PRESTAMO', '=', 'tp.id')
                ->join('estadoPrestamo AS ep', 'Prestamo.ID_ESTADO_PRESTAMO', '=', 'ep.id')
                ->join('materialBibliotecario AS mb', 'Prestamo.ID_MATERIAL', '=', 'mb.id')
                ->join('Ejemplar AS ej', 'mb.ID_EJEMPLAR', '=', 'ej.id')
                ->join('catalogoMaterial AS cm', 'ej.ID_CATALOGO_MATERIAL', '=', 'cm.id')
                ->get();
        }
        return ($query);
    }
}
