<?php

namespace App\Http\Controllers;

use App\segundoSumario;
use Illuminate\Http\Request;

class SegundoSumarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function segundoSumarioSelect($id)
    {
        $segundoSumarios = segundoSumario::where('ID_PRIMER_SUMARIO',$id)->get();
        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' =>'Seleccione',
        ];
        foreach ($segundoSumarios as $key => $value) {
            $data[$key+1] =[
                'id'   => $value->id,
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
     * @param  \App\segundoSumario  $segundoSumario
     * @return \Illuminate\Http\Response
     */
    public function show(segundoSumario $segundoSumario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\segundoSumario  $segundoSumario
     * @return \Illuminate\Http\Response
     */
    public function edit(segundoSumario $segundoSumario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\segundoSumario  $segundoSumario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, segundoSumario $segundoSumario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\segundoSumario  $segundoSumario
     * @return \Illuminate\Http\Response
     */
    public function destroy(segundoSumario $segundoSumario)
    {
        //
    }
}
