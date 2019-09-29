<?php

namespace App\Http\Controllers;

use App\materialBibliotecario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialBibliotecarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            /* $materialBibliotecario = DB::table('materialBibliotecario')
                ->join('Ejemplar', 'materialBibliotecario.ID_EJEMPLAR', '=', 'Ejemplar.id')
                ->leftJoin('filaEstante', 'materialBibliotecario.ID_FILA', '=', 'filaEstante.id')
                ->select('Ejemplar.ID_CATALOGO_MATERIAL', 'Ejemplar.EJEMPLAR', 'materialBibliotecario.COPIA_NUMERO', 'Ejemplar.ID_TERCER_SUMARIO', 'materialBibliotecario.CODIGO_BARRA', 'filaEstante.*')
                ->get();*/
            $materialBibliotecario = DB::table('busquedamaterialprestamosview')->get();
            return $materialBibliotecario;
        } else {
            return redirect('home');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\materialBibliotecario  $materialBibliotecario
     * @return \Illuminate\Http\Response
     */
    public function show(materialBibliotecario $materialBibliotecario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\materialBibliotecario  $materialBibliotecario
     * @return \Illuminate\Http\Response
     */
    public function edit(materialBibliotecario $materialBibliotecario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\materialBibliotecario  $materialBibliotecario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, materialBibliotecario $materialBibliotecario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\materialBibliotecario  $materialBibliotecario
     * @return \Illuminate\Http\Response
     */
    public function destroy(materialBibliotecario $materialBibliotecario)
    {
        //
    }
}
