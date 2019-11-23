<?php

namespace App\Http\Controllers;

use App\Comentario;
use App\interaccionComentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Aporte;
use App\Puntuaciones;
use App\Niveles;
use App\User;

use App\Notifications\NuevoComentario;
use Illuminate\Support\Facades\Notification;

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
            ])
            ->latest()
            ->get();
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
        activity()->performedOn($InteraccionComentario)->log('Dió Like');
    }

    public function interaccionDislike($id)
    {
        $InteraccionComentario = interaccionComentario::find($id);
        $InteraccionComentario->delete();
        activity()->performedOn($InteraccionComentario)->log('Quitó Like');
    }
//HEchos para la seccion de comentarios sin vue--------------------------------------------------
    public function darLike(Request $request)
    {
        $InteraccionComentario = new interaccionComentario();
        $InteraccionComentario->ID_TIPO_INTERACCION=1;
        $InteraccionComentario->ID_COMENTARIO= $request->comentario;
        $InteraccionComentario->ID_USUARIO = auth()->id();
        $InteraccionComentario->save();
        activity()->performedOn($InteraccionComentario)->log('Dió Like');
    }

    public function darDislike(Request $request)
    {
        $InteraccionComentario = interaccionComentario::find($request->interaccion);
        $InteraccionComentario->delete();
        activity()->performedOn($InteraccionComentario)->log('Quitó Like');
    }

    public function guardarComentario(Request $request)
    {
        // dd($request);
        $id= (int)$request->aporte;
            // dd($id);
        try {
            $Comentario =new Comentario();
            $Comentario->COMENTARIO = $request->comentario;
            $Comentario->ID_USUARIO = auth()->id();
            $Comentario->ID_APORTE = $request->aporte;
            $Comentario->save();

            $Aporte = Aporte::find($request->aporte);
            $user = User::find($Aporte->ID_USUARIO);
            $user->notify(new NuevoComentario($Comentario)); //Esto notifica a un solo usuario
            //Notification::send($user, new NewAporte($Aporte)); //Esto notifica a varios usuarios
            activity()->performedOn($Comentario)->log('Realizó comentario');
            
            return redirect('/aportes/'.$id);
        } catch (Exception $e) {
            return $e->getMessage();     
        }
        
    }
// FIN HEchos para la seccion de comentarios sin vue----------------------------------

    
    public function interaccionReport(Request $request)
    {
        $InteraccionComentario = new interaccionComentario();
        $InteraccionComentario->DESCRIPCION = $request->DESCRIPCION;
        $InteraccionComentario->ID_TIPO_INTERACCION=1;
        $InteraccionComentario->ID_COMENTARIO= $request->ID_COMENTARIO;
        $InteraccionComentario->ID_USUARIO = $request->ID_USUARIO;
        $InteraccionComentario->save();
        activity()->performedOn($Comentario)->log('Reportó');
    }
    public function interaccionesComentario(Request $request)
    {
        return DB::table('opcionescomentario')
        ->where([
            ['ID_APORTE', '=', $request->id],
            ['HABILITADO','=','1'],
            ['ID_USUARIO_INTERACCION','=',auth()->id()]
        ])
        ->select('ID_COMENTARIO', 'HABILITADO','ID_APORTE','ID_TIPO_INTERACCION','ID_USUARIO_INTERACCION')
        ->get();
    }

    public function interacciones(Request $request)
    {
        return DB::table('interaccionComentario')
        ->where([
            ['ID_COMENTARIO',$request->id],
            ['ID_USUARIO',auth()->id()]
        ])
        ->get();
    }

    public function interactue(Request $request)
    {
        return Comentario::select('Comentario.id', 'interaccionComentario.id as int')
        ->join('interaccionComentario', 'Comentario.id', '=', 'interaccionComentario.ID_COMENTARIO')
        ->where('interaccionComentario.ID_USUARIO', '=', auth()->id() )
        ->get();
    }

    public function interactue_prueba(Request $request)
    {
        $interactue =  Comentario::select('Comentario.*')
        ->join('interaccionComentario', 'Comentario.id', '=', 'interaccionComentario.ID_COMENTARIO')
        ->where('Comentario.HABILITADO','=','1')
        ->where('interaccionComentario.ID_USUARIO', '=', auth()->id() )
        ->where('Comentario.ID_APORTE', '=', $request->idA)
        ->where('Comentario.id', '=', $request->idC)
        ->get();

        if( sizeof($interactue) < 1 ){
            return 'no';
        }else{
            return 'si';
        }

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

        $Aporte = Aporte::find($request->ID_APORTE);
        $user = User::find($Aporte->ID_USUARIO);
        $user->notify(new NuevoComentario($Comentario)); //Esto notifica a un solo usuario
        //Notification::send($user, new NewAporte($Aporte)); //Esto notifica a varios usuarios
        activity()->performedOn($Comentario)->log('Hizo comentario con id: '.$Comentario->id);
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

    public function todos(Request $request)
    {
        if($request->ajax()){
            return Comentario::where('ID_APORTE',$request->id)->get();
        }else{
            return redirect()->route('home');
        }
    }

    public function habilitar(Request $request){

        $comentario = Comentario::find($request->id);
        if($comentario->HABILITADO){
            $comentario->HABILITADO = false;
        }else{
            $comentario->HABILITADO = true;
        }
        $comentario->save();
        $user = User::find($comentario->ID_USUARIO);
        $user->notify(new NuevoComentario($comentario));

        if($comentario->HABILITADO){
            activity()->performedOn($comentario)->log('Comentario '.$comentario->id.' habilitado');
            //Actualizar puntuacion Habilitar Comentario//
            $Puntuaciones = Puntuaciones::find(8);
            $Niveles = Niveles::all();
            $Usuario = User::find($comentario->ID_USUARIO);
            $Usuario->PUNTOS += $Puntuaciones->VALOR;
            $Niveles = Niveles::all();
            foreach ($Niveles as $nivel) {
             
                if($Usuario->PUNTOS >= $nivel->PUNTAJE_MINIMO){
                     $Usuario->ID_NIVEL = $nivel->id;
                }
            }
            $Usuario->save();
            //Actualizar puntuacion habilitar Comentario// 
        }else{
            activity()->performedOn($comentario)->log('Comentario '.$comentario->id.' deshabilitado');
        }
        return '1';
    }
}
