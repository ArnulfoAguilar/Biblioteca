<?php

namespace App\Http\Controllers;

use App\Biblioteca;
use Illuminate\Http\Request;

class BibliotecaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function biblioteca(){
        return view('Biblioteca.listaBiblioteca');
    }
    public function index()
    {
        $biblioteca= Biblioteca::all();
        return $biblioteca;
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
        $biblioteca = new Biblioteca();
        $biblioteca->BIBLIOTECA = $request->BIBLIOTECA;
        $biblioteca->save();
        activity()->performedOn($biblioteca)->log('Biblioteca guardada ('.$biblioteca->BIBLIOTECA.')');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Biblioteca  $biblioteca
     * @return \Illuminate\Http\Response
     */
    public function show(Biblioteca $biblioteca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Biblioteca  $biblioteca
     * @return \Illuminate\Http\Response
     */
    public function edit(Biblioteca $biblioteca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Biblioteca  $biblioteca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $biblioteca = Biblioteca::find($id);
        $biblioteca->BIBLIOTECA = $request ->BIBLIOTECA;
        $biblioteca->save();
        activity()->performedOn($biblioteca)->log('Biblioteca actualizada ('.$biblioteca->BIBLIOTECA.')');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Biblioteca  $biblioteca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $biblioteca = Biblioteca::find($id);
        $biblioteca->delete();
        activity()->log('Biblioteca eliminada ('.$biblioteca->BIBLIOTECA.')');
    }
}
