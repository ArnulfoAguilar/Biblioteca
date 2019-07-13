<?php

namespace App\Http\Controllers;

use App\primerSumario;
use Illuminate\Http\Request;

class PrimerSumarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function primerSumarioSelect()
    {
        $primerSumarios = primerSumario::all();
        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' =>'Seleccione',
        ];
        foreach ($primerSumarios as $key => $value) {
            $data[$key+1] =[
                'id'   => $value->ID_PRIMER_SUMARIO,
                'text' => $value->DESCRIPCION,
            ];
        }
        return response()->json($data);
    }
    public function index()
    {
        //
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
     * @param  \App\primerSumario  $primerSumario
     * @return \Illuminate\Http\Response
     */
    public function show(primerSumario $primerSumario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\primerSumario  $primerSumario
     * @return \Illuminate\Http\Response
     */
    public function edit(primerSumario $primerSumario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\primerSumario  $primerSumario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, primerSumario $primerSumario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\primerSumario  $primerSumario
     * @return \Illuminate\Http\Response
     */
    public function destroy(primerSumario $primerSumario)
    {
        //
    }
}
