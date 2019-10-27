<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

//use Spatie\Activitylog\Models\Activity;

class GraficosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->fecha_i == null && $request->fecha_f == null ){
            $aportes = DB::table('Aporte')->select(DB::raw('count(*) as cuenta, "ID_AREA"'))
            ->groupBy('ID_AREA')->get();
        }elseif ($request->fecha_i != null && $request->fecha_f != null) {
            $aportes = DB::table('Aporte')->select(DB::raw('count(*) as cuenta, "ID_AREA"'))
            ->where('created_at', '>=', $request->fecha_i)
            ->where('created_at', '<=', $request->fecha_f)
            ->groupBy('ID_AREA')->get();
        }
        else {
            if($request->fecha_f == null){
                $aportes = DB::table('Aporte')->select(DB::raw('count(*) as cuenta, "ID_AREA"'))
                ->where('created_at', '>=',  $request->fecha_i)
                ->groupBy('ID_AREA')->get();
            }elseif ($request->fecha_i == null) {
                $aportes = DB::table('Aporte')->select(DB::raw('count(*) as cuenta, "ID_AREA"'))
                ->where('created_at', '<=',  $request->fecha_f)
                ->groupBy('ID_AREA')->get();
            }else{
                $aportes = DB::table('Aporte')->select(DB::raw('count(*) as cuenta, "ID_AREA"'))
                ->groupBy('ID_AREA')->get();
            }
        }

        $lista[] =['Area', 'Cantidad'];

        $areas = DB::table('Area')->select('id','AREA')->get();
        
        foreach ($areas as $key_a => $area) {
            $cero = true;
            foreach ($aportes as $key_ap => $aporte) {
                if($area->id == $aporte->ID_AREA){
                    $cero = false;
                    $lista[++$key_a] = [$area->AREA, $aporte->cuenta];
                }
            }
            if($cero == true){
                $lista[++$key_a] = [$area->AREA, 0];
            }
            
        }

        return view('Graficos.aportes')
        ->with([
            'lista' => json_encode($lista),
            'fecha_i' => $request->fecha_i,
            'fecha_f' => $request->fecha_f,
        ]);
    }

    public function aportesAnio(Request $request)
    {
        $meses = ['-','Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        $lista[] =['Mes'];
        $areas = DB::table('Area')->get();
        foreach ($areas as $key => $area) {
           array_push($lista[0], $area->AREA);
        }

        if($request->anio && $request->anio > 0){
            for ($i=1; $i<13 ; $i++) { 
                $elemento=[$meses[$i]];
                foreach ($areas as $key => $area) {
                    $consulta = DB::table('Aporte')
                    ->where('ID_AREA', $area->id)
                    ->whereRaw('extract(month from created_at) = ?', [$i])
                    ->whereRaw('extract(year from created_at) = ?', [$request->anio])
                    ->count();
                    array_push($elemento, $consulta );                
                }
                array_push($lista, $elemento );
            }
        }else{
            for ($i=1; $i<13 ; $i++) { 
                $elemento=[$meses[$i]];
                foreach ($areas as $key => $area) {
                    $consulta = DB::table('Aporte')
                    ->where('ID_AREA', $area->id)
                    ->whereRaw('extract(month from created_at) = ?', [$i])
                    ->count();
                    array_push($elemento, $consulta );                
                }
                array_push($lista, $elemento );
            }
        }
                
        return view('Graficos.aportes-anio')
        ->with([
            'lista' => json_encode($lista),
            'anio' => $request->anio
        ]);
        
    }

    
}
