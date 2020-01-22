<?php

namespace App\Http\Controllers;

use App\tercerSumario;
use Illuminate\Http\Request;

class TercerSumarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function  tercerSumarioSelect($id)
    {
        if($id>0)
            $segundoSumarios = tercerSumario::where('ID_SEGUNDO_SUMARIO',$id)->get();
        else
            $segundoSumarios = tercerSumario::all();

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
     * @param  \App\tercerSumario  $tercerSumario
     * @return \Illuminate\Http\Response
     */
    public function show(tercerSumario $tercerSumario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tercerSumario  $tercerSumario
     * @return \Illuminate\Http\Response
     */
    public function edit(tercerSumario $tercerSumario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tercerSumario  $tercerSumario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tercerSumario $tercerSumario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tercerSumario  $tercerSumario
     * @return \Illuminate\Http\Response
     */
    public function destroy(tercerSumario $tercerSumario)
    {
        //
    }
}
