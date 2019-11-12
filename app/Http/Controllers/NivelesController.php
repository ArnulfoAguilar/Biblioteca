<?php

namespace App\Http\Controllers;

use App\Niveles;
use Illuminate\Http\Request;

class NivelesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $niveles= Niveles::all();
        return view('administracion.Niveles')
        ->with(['niveles' => $niveles]);
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
     * @param  \App\Niveles  $niveles
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $niveles= Niveles::find($id);
        return $niveles;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Niveles  $niveles
     * @return \Illuminate\Http\Response
     */
    public function edit(Niveles $niveles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Niveles  $niveles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Niveles $niveles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Niveles  $niveles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Niveles $niveles)
    {
        //
    }
}