<?php

namespace App\Http\Controllers;

use App\Estante;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class EstanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function estante()
    {
        return view('Estante.Lista');
    }

    public function index()
    {
        $estantes = DB::table('Biblioteca')
            ->join('Estante', 'Biblioteca.id', '=', 'Estante.ID_BIBLIOTECA')
            ->get();
        return $estantes;
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
        $estante = new Estante();
        $estante->ESTANTE = $request->ESTANTE;
        $estante->ID_BIBLIOTECA = $request->ID_BIBLIOTECA;
        $estante->CLASIFICACION = '';
        $estante->save();
        activity()->log('Guardó estante');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function show(Estante $estante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estante $estante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $estante = Estante::find($id);
        $estante->ESTANTE = $request->ESTANTE;
        $estante->ID_BIBLIOTECA = $request->ID_BIBLIOTECA;
        $estante->CLASIFICACION = '';
        $estante->save();
        activity()->log('Actualizó estante');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estante  $estante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estante = Estante::find($id);
        $estante->delete();
        activity()->log('Eliminó estante');

    }

    public function estanteToSelect($id){
        $estantes = Estante::where('ID_BIBLIOTECA', $id)->get();
        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' => 'Seleccione',
        ];
        foreach ($estantes as $key => $value) {
            $data[$key + 1] = [
                'id'   => $value->id,
                'text' => $value->ESTANTE,
            ];
        }
        return response()->json($data);
    }
}
