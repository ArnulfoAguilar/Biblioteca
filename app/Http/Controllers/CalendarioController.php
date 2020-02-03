<?php

namespace App\Http\Controllers;

use App\Calendario;
use App\Modelos\Prestamo;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $eventos = Calendario::all();
            $events=array();
            foreach ($eventos as $evento) {
                $eventToFetch=array(
                    'id'=>$evento->id,
                    'start'=>$evento->inicio_inactividad,
                    'end'=>$evento->fin_inactividad,
                    'title'=>$evento->nombre_inactividad,
                    'allDay'=>true
                );
                array_push($events,$eventToFetch);
            }
            return $events;
        } else {
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
        if($request->ajax()){
            $evento = new Calendario();
            $evento->inicio_inactividad = $request->start;
            $fecha_i = $request->start;
            $evento->fin_inactividad = $request->end;
            $fecha_f = $request->end;
            $evento->nombre_inactividad = $request->title;
            $evento->año_fecha = $request->year;
            $evento->save();
        }

        $prestamos = Prestamo::whereIn('ID_ESTADO_PRESTAMO', ['3','4','6'])->get();
        foreach ($prestamos as $key => $prestamo) {
            $fecha_esp_dev = date("Y-m-d",strtotime($prestamo->FECHA_ESPERADA_DEVOLUCION));
            if($request->end == null){
                if( $fecha_esp_dev == $request->start){
                    $prestamo->FECHA_ESPERADA_DEVOLUCION = date("Y-m-d",strtotime($request->start));
                    $prestamo->save();
                }
            }else{
                if($fecha_esp_dev >= $request->start && $fecha_esp_dev <= $request->end ){
                    $prestamo->FECHA_ESPERADA_DEVOLUCION = date("Y-m-d",strtotime($request->end));
                    $prestamo->save();
                }
            }
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function show(Calendario $calendario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendario $calendario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendario $calendario)
    {
        if ($request->ajax()) {
            $Calendario = Calendario::find($calendario->id);
            $Calendario->nombre_inactividad = $request->title;
            $Calendario->inicio_inactividad = $request->start;
            $Calendario->fin_inactividad = $request->end;
            $Calendario->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendario $calendario)
    {
        $evento=Calendario::find($calendario->id);
        $evento->delete();
    }
}
