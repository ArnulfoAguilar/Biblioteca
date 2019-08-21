<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Revision;

class RevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        if($request->ajax()){
            return Revision::where('ID_APORTE', $request->id)->orderBy('id', 'asc')->get();
        }else{
            return view('home');
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
        $revision = new Revision();
        $revision->DETALLE_REVISION = $request->DETALLE_REVISION;
        $revision->ID_ESTADO_REVISION = 2;
        $revision->ID_COMITE = $request->ID_COMITE;
        $revision->ID_APORTE = $request->ID_APORTE;
        $revision->ID_USUARIO = auth()->id();
        $revision->Save();
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
        $revision = Revision::find($id);
        $revision->DETALLE_REVISION = $request->DETALLE_REVISION;
        if($request->ID_ESTADO_REVISION==true){
            $revision->ID_ESTADO_REVISION = 1;
        }else{
            $revision->ID_ESTADO_REVISION = 2;
        }
        $revision->ID_COMITE = $request->ID_COMITE;
        $revision->ID_APORTE = $request->ID_APORTE;
        $revision->ID_USUARIO = auth()->id();
        $revision->Save();
        return $revision;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $revision = Revision::find($id);
        $revision->delete();
    }
}
