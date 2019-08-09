<?php

namespace App\Http\Controllers;

use App\Aporte;
use Illuminate\Http\Request;

class AporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return view('Aportes.NuevoAporte');
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
     * @param  \App\Aporte  $aporte
     * @return \Illuminate\Http\Response
     */
    public function show(Aporte $aporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aporte  $aporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Aporte $aporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aporte  $aporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aporte $aporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aporte  $aporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aporte $aporte)
    {
        //
    }
}
