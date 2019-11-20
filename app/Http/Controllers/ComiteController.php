<?php

namespace App\Http\Controllers;

use App\Comite;
use App\Area;
use App\User;
use Illuminate\Http\Request;

class ComiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
            return Comite::all();
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
        //

        $newArea = new Area();
        $newArea->AREA = $request->COMITE;
        $newArea->Save();

        $newComite = new Comite();
        $newComite->COMITE = $request->COMITE;
        $newComite->ID_AREA = $newArea->id;
        $newComite->Save();

        activity()->performedOn($newComite)->log('Guardó comite ('.$newComite->COMITE.')');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comite  $comite
     * @return \Illuminate\Http\Response
     */
    public function show(Comite $comite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comite  $comite
     * @return \Illuminate\Http\Response
     */
    public function edit(Comite $comite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comite  $comite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comite $comite)
    {
        //
        $newComite = Comite::find($request->id);
        $newArea = Area::find($request->id);
        $newComite->COMITE = $request->COMITE;
        $newArea->AREA = $request->COMITE;
        $newComite->save();
        $newArea->save();
        activity()->performedOn($newComite)->log('Actualizó comite ('.$newComite->COMITE.')');
        return $newComite;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comite  $comite
     * @return \Illuminate\Http\Response
     */
    public function destroy($comite)
    {
        $newComite = Comite::find($comite);
        $newArea = Area::find($comite);
        $comite = $newComite->COMITE;
        $newComite->delete();
        $newArea->delete();
        activity()->performedOn($newComite)->log('Eliminó comite ('.$comite.')');
    }

    public function asignarComiteIndex($user = null)
    {
        if($user){
            $user= User::find($user);
        }
        $comites = Comite::all();
        $usuarios = User::orderBy('id', 'ASC')->get();
        return view('administracion.asignacion-comites')->with([
            'comites' => $comites,
            'usuarios' => $usuarios,
            'user' => $user
        ]);
    }
    
}
