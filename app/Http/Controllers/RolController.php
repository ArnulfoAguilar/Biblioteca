<?php

namespace App\Http\Controllers;

use App\Rol;
use App\User;
use Illuminate\Http\Request;

class RolController extends Controller
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
            return Rol::all();
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
        $newRol = new Rol();
        $newRol->ROL = $request->ROL;
        $newRol->Save();
        activity()->performedOn($newRol)->log('Guardó rol ('.$newRol->ROL.')');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function show(Rol $rol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function edit(Rol $rol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rol $rol)
    {
        //
        $newRol = Rol::find($request->id);
        $newRol->ROL = $request->ROL;
        $newRol->save();
        activity()->performedOn($newRol)->log('Actualizó rol ('.$newRol->ROL.')');
        return $newRol;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function destroy($role)
    {
        $newRol = Rol::find($role);
        $newRol->delete();
        activity()->performedOn($newRol)->log('Eliminó rol ('.$newRol->ROL.')');
    }

    public function asignarRolIndex($user = null)
    {
        if($user){
            $user= User::find($user);
        }
        $roles = Rol::all();
        $usuarios = User::orderBy('id', 'ASC')->get();
        return view('administracion.asignacion-roles')->with([
            'roles' => $roles,
            'usuarios' => $usuarios,
            'user' => $user
        ]);
    }
    
}
