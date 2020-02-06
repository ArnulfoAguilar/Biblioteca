<?php

namespace App\Http\Controllers;

use App\Notifications\Revisiones;
use Illuminate\Http\Request;
use App\Revision;
use App\Modelos\Aporte;

use App\User;

use App\Notifications\NuevaRevision;
use App\Notifications\RevisionSolventada;
use Illuminate\Support\Facades\Notification;

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
            return Revision::where('ID_APORTE', $request->id)->orderBy('created_at', 'desc')->get();
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
        $revision->save();

        $user = User::find($revision->aporte->usuario->id);
        $user->notify(new NuevaRevision($revision));
        activity()->performedOn($revision)->log('Guardó revisión ('.$revision->id.')');

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

        // $user = User::find(auth()->id());
        // $user->notify(new NuevaRevision($revision));
        // activity()->performedOn($revision)->log('Actualizó revisión ('.$revision->id.')');
        // $Aporte = Aporte::find($request->ID_APORTE);
        // $user = User::find($Aporte->ID_USUARIO);
        // $user->notify(new Revisiones($revision));

        $user = User::find($revision->aporte->usuario->id);
        if($revision->ID_ESTADO_REVISION == 2){
            $user->notify(new NuevaRevision($revision));
        }else{
            $user->notify(new RevisionSolventada($revision));
        }
        activity()->performedOn($revision)->log('Modificó revisión ('.$revision->id.')');
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
        activity()->performedOn($revision)->log('Eliminó revisión ('.$revision->id.')');
    }
}
