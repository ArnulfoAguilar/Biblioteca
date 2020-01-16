<?php

namespace App\Http\Controllers;

use App\materialBibliotecario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MaterialBibliotecarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $qry = DB::table('busquedamaterialprestamosview')->get();
            if ($request->titulo != "") {
                $qry = DB::table('busquedamaterialprestamosview')->where('EJEMPLAR', 'like', '%' . $request->titulo . '%')->get();
            }
            if ($request->autor != "") {
                $qry = DB::table('busquedamaterialprestamosview')->where('AUTOR', 'like', '%' . $request->autor . '%')->get();
            }
            if ($request->isbn != "") {
                $qry = DB::table('busquedamaterialprestamosview')->where('ISBN', 'like', '%' . $request->isbn . '%')->get();
            }
            return $qry;
        } else {
            return redirect('home');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\materialBibliotecario  $materialBibliotecario
     * @return \Illuminate\Http\Response
     */
    public function show(materialBibliotecario $materialBibliotecario)
    {
        //
    }

    public function findBarcode($barcode)
    {
        $consulta = DB::table('busquedamaterialprestamosview')->where('CODIGO_BARRA', '=', $barcode)->first();
        return response()->json($consulta);
    }
    
    public function Inventariar(Request $request)
    {
        $materialBibliotecario = materialBibliotecario::find($request->ID_MATERIAL_BIBLIOTECARIO);
        $materialBibliotecario->OBSERVACIONES = $request->OBSERVACIONES;
        $materialBibliotecario->FECHA_INVENTARIADO = Carbon::now();
        $materialBibliotecario->save();
        return view('administracion.inventariarLibros');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\materialBibliotecario  $materialBibliotecario
     * @return \Illuminate\Http\Response
     */
 
}
