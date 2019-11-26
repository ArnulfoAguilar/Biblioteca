<?php

namespace App\Http\Controllers;

use App\Adquisicion;
use App\User;
use Auth;
use DB;

use Illuminate\Http\Request;


class AdquisicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Adquisicion::orderBy('created_at','asc')->get();
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
        try {
            $sugerencia = new Adquisicion();
            $sugerencia->TITULO = $request->TITULO;
            $sugerencia->DESCRIPCION = $request->DESCRIPCION;
            $sugerencia->CONTENIDO = $request->CONTENIDO;
            $sugerencia->ID_AREA = $request->ID_AREA;
            $sugerencia->ID_USUARIO = auth()->id();
            $sugerencia->save();
            activity()->performedOn($sugerencia)->log('Sugerencia de adquisición guardada ('.$sugerencia->TITULO.')');
        } catch (\Throwable $th) {
            //throw $th;
        }
        
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
        try {
            $sugerencia = Adquisicion::find($id);
            $sugerencia->TITULO = $request->TITULO;
            $sugerencia->DESCRIPCION = $request->DESCRIPCION;
            $sugerencia->CONTENIDO = $request->CONTENIDO;
            $sugerencia->ID_AREA = $request->ID_AREA;
            $sugerencia->ID_USUARIO = auth()->id();
            $sugerencia->save();
            activity()->performedOn($sugerencia)->log('Sugerencia de adquisición actualizada ('.$sugerencia->TITULO.')');
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sugerencia = Adquisicion::find($id);
        $sugerencia_nombre = $sugerencia->TITULO;
        $sugerencia->delete();
        activity()->performedOn($sugerencia)->log('Sugerencia de adquisición eliminada ('.$sugerencia_nombre.')');
    }

    public function interacciones(Request $request){
        // dd($request, Auth::user()->id);
        $adquisiciones = Adquisicion::orderBy('created_at','asc')->get();
        $cuenta_por_adq = [];
        foreach ($adquisiciones as $key => $adquisicion) {
            $cuentas = [];
            $mis_int = DB::table('interaccion_sugerencia')
            ->where('ID_USUARIO', Auth::user()->id)
            ->where('ID_SUGERENCIA', $adquisicion->id)
            ->count();
            $interacciones = DB::table('interaccion_sugerencia')
            ->where('ID_SUGERENCIA', $adquisicion->id)
            ->count();
            // dd($interacciones);
            array_push($cuentas, $interacciones);
            if ($mis_int == 0) {
                array_push($cuentas, false);
            }else{
                array_push($cuentas, true);
            }

            array_push($cuenta_por_adq, $cuentas);
            
        }
        return $cuenta_por_adq;
    }

    public function nuevaInteraccion(Request $request){
        $user = Auth::user();
        $adquisicion = Adquisicion::find($request->id);
        $user->interaccionesSugerencias()->attach($adquisicion);
        $user->save();
        return redirect()->route('adquisicion.lista');
    }
    public function quitarInteraccion(Request $request){
        $user = Auth::user();
        $adquisicion = Adquisicion::find($request->id);
        $user->interaccionesSugerencias()->detach($adquisicion);
        $user->save();
        return redirect()->route('adquisicion.lista');
    }
}
