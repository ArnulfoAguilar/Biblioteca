<?php

namespace App\Http\Controllers;

use App\Comentario;
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


        return DB::table('opcionescomentario')->where([
            ['ID_APORTE', '=', '1'],
            ['AUTOR_COMENTARIO', '=', '1'],
        ])->get();
        /*if($request->ajax()){
            return DB::table('Comentario')
                    ->join('users', function($join) use ($request) {
                        $join->on('users.id','=','Comentario.ID_USUARIO')
                        ->where([
                            ['Comentario.ID_APORTE','=',$request->id],
                            ['Comentario.HABILITADO','=','1']
                        ]);
                    })
                    ->select('Comentario.*','users.name')
                    ->get();
        }else{
             return redirect()->route('home');
        }*/
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
