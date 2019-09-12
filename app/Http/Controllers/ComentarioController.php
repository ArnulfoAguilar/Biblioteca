<?php

namespace App\Http\Controllers;

use App\Comentario;
use App\interaccionComentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->ajax()){
            return DB::table('comentarioslikes')->where([
                ['ID_APORTE', '=', $request->id],
                ['HABILITADO','=','1']
            ])->get();
        }else{
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function interaccionLike(Request $request)
    {
        $InteraccionComentario = new interaccionComentario();
        $InteraccionComentario->ID_TIPO_INTERACCION=1;
        $InteraccionComentario->ID_COMENTARIO= $request->ID_COMENTARIO;
        $InteraccionComentario->ID_USUARIO = $request->ID_USUARIO;
        $InteraccionComentario->save();
    }
    
    public function interaccionReport(Request $request)
    {
        $InteraccionComentario = new interaccionComentario();
        $InteraccionComentario->DESCRIPCION = $request->DESCRIPCION;
        $InteraccionComentario->ID_TIPO_INTERACCION=1;
        $InteraccionComentario->ID_COMENTARIO= $request->ID_COMENTARIO;
        $InteraccionComentario->ID_USUARIO = $request->ID_USUARIO;
        $InteraccionComentario->save();
    }
    public function interaccionesComentario(Request $request)
    {
        return DB::table('opcionescomentario')->where([
            ['ID_APORTE', '=', $request->id],
            ['HABILITADO','=','1'],
            ['ID_USUARIO_INTERACCION','=',auth()->id()]
        ])
        ->select('ID_COMENTARIO', 'HABILITADO','ID_APORTE','ID_TIPO_INTERACCION','ID_USUARIO_INTERACCION')
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Comentario =new Comentario();
        $Comentario->COMENTARIO = $request->COMENTARIO;
        $Comentario->ID_USUARIO = $request->ID_USUARIO;
        $Comentario->ID_APORTE = $request->ID_APORTE;
        $Comentario->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function show(Comentario $comentario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function edit(Comentario $comentario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comentario $comentario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comentario $comentario)
    {
        //
    }
}
