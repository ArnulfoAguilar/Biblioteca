<?php

namespace App\Http\Controllers;

use App\Modelos\Prestamo;
use App\Modelos\Ejemplar;
use App\tipoPrestamo;
use App\tipoPenalizacion;
use App\materialBibliotecario;
use App\Prorroga;
use App\Penalizacion;
use App\User;
use App\Configuracion;
use App\Aporte;
use Illuminate\Http\Request;

use DB;

use App\Notifications\PrestamoAprobado;
use App\Notifications\NuevaPenalizacion;
use Illuminate\Support\Facades\Notification;

class PrestamosController extends Controller
{
    public function index(Request $request)
    {


        $prestamos = DB::table('Prestamo')
        ->select('Prestamo.*', 'Ejemplar.EJEMPLAR', 'estadoPrestamo.ESTADO_PRESTAMO',
        'users.name', 'Ejemplar.AUTOR', 'Ejemplar.EDICION', 'Ejemplar.ID_TIPO_ADQUISICION',
        'tipoAdquisicion.NOMBRE as tipoAdquisicion', 'tipoPrestamo.TIPO_PRESTAMO as tipoPrestamo',
        'materialBibliotecario.COPIA_NUMERO as copia'
         )
        ->join('materialBibliotecario', 'materialBibliotecario.id', '=', 'Prestamo.ID_MATERIAL')
        ->join('Ejemplar', 'Ejemplar.id', '=', 'materialBibliotecario.ID_EJEMPLAR')
        ->join('estadoPrestamo', 'estadoPrestamo.id', '=', 'Prestamo.ID_ESTADO_PRESTAMO')
        ->join('tipoAdquisicion', 'tipoAdquisicion.ID_TIPO_ADQUISICION', '=', 'Ejemplar.ID_TIPO_ADQUISICION')
        ->join('users', 'users.id', '=', 'Prestamo.ID_USUARIO')
        ->leftjoin('tipoPrestamo', 'tipoPrestamo.id', '=', 'Prestamo.ID_TIPO_PRESTAMO')
        ->where('Prestamo.ID_ESTADO_PRESTAMO', '!=', '8')
        ->paginate(10);

        $tiposPrestamos = tipoPrestamo::all();
        $tiposPenalizaciones = tipoPenalizacion::all();

        return view('Prestamo.prestamos')->with([
            'prestamos'=> $prestamos,
            'tiposPrestamos'=> $tiposPrestamos,
            'tiposPenalizaciones'=> $tiposPenalizaciones,
        ]);
    }

    public function misPrestamos(Request $request)
    {
        $prestamos = Prestamo::where('ID_USUARIO', auth()->id())->orderBy('created_at', 'asc')->get();

        return view('Prestamo.misPrestamos')->with([
            'prestamos'=> $prestamos,
        ]);
    }

    public function realizarPrestamo(Request $request)
    {
        $cuentas = [];
        $ejemplares = Ejemplar::paginate(20);
        foreach ($ejemplares as $key => $ejemplar) {
            $cuentas[] += materialBibliotecario::where('ID_EJEMPLAR', $ejemplar->id)
            ->where('DISPONIBLE', true)->count();
        }
        
        $tiposPrestamos = tipoPrestamo::all();
        $penalizado=false;
        $penalizaciones = Penalizacion::where('SOLVENTADA', '!=', true)->get();
        foreach ($penalizaciones as $key => $penalizacion) {
            if ($penalizacion->prestamo->usuario->id == auth()->id() && $penalizacion->tipo->id == 3) {
                $penalizado=true;
            }
        }

        $aportes = Aporte::where('HABILITADO', true)->get();

        return view('Prestamo.realizarPrestamos')->with([
            'ejemplares'=> $ejemplares,
            'aportes'=> $aportes,
            'cuentas'=> $cuentas,
            'penalizado' => $penalizado,
        ]);
    }

    public function solicitarPrestamo(Request $request)
    {
        $prestamo =  new Prestamo();
        // $prestamo->FECHA_PRESTAMO = date('Ymd H:i:s');

        $prestamo->ID_USUARIO = auth()->id();
        $prestamo->ID_ESTADO_PRESTAMO = 1;
        // $prestamo->ID_TIPO_PRESTAMO = $request->tipoPrestamo;
        $material = materialBibliotecario::select('id')
        ->where('ID_EJEMPLAR', $request->id)
        ->where('DISPONIBLE', true)
        ->first();     
        $prestamo->ID_MATERIAL = $material->id;
               
        $material = materialBibliotecario::find($prestamo->ID_MATERIAL);
        $material->DISPONIBLE = false;

        $prestamo->save();
        $material->save();

        activity()->performedOn($prestamo)->log('Solicitó un préstamo ('.$prestamo->id.') ');

    }

    public function reservarPrestamo(Request $request)
    {
        $prestamo = Prestamo::find($request->id);
        $prestamo->ID_ESTADO_PRESTAMO = 2;

        $prestamo->save();

        $user = User::find(  $prestamo->ID_USUARIO );
        $user->notify(new PrestamoAprobado($prestamo));

        activity()->performedOn($prestamo)->log('Reservó un préstamo ('.$prestamo->id.') ');

    }

    public function aprobarPrestamo(Request $request)
    {
        $prestamo = Prestamo::find($request->id);
        $prestamo->ID_ESTADO_PRESTAMO = 3;
        $prestamo->ID_TIPO_PRESTAMO = $request->tipoPrestamo;
        $prestamo->FECHA_PRESTAMO = date('Ymd H:i:s');

        $diasHabilitar = Configuracion::select('DIAS_HABILES_PRORROGA')->get();
        foreach ($diasHabilitar as $dia) {
            $dias = "+ ".(string)$dia->DIAS_HABILES_PRORROGA." days";
        }

        $devolucion = date("d-m-Y",strtotime($prestamo->FECHA_PRESTAMO.$dias));

        $prestamo->FECHA_ESPERADA_DEVOLUCION = PrestamosController::verificarDevolucion($devolucion);
       
        if($prestamo->tipoPrestamo->id == 4){
            $prestamo->FECHA_ESPERADA_DEVOLUCION = date('Ymd H:i:s');
        }

        $material = materialBibliotecario::find($prestamo->ID_MATERIAL);
        $material->DISPONIBLE = false;

        $prestamo->save();
        $material->save();

        activity()->performedOn($prestamo)->log('Aprobó un préstamo ('.$prestamo->id.') ');


    }

    public function finalizarPrestamo(Request $request)
    {
        $prestamo = Prestamo::find($request->id);
        $prestamo->ID_ESTADO_PRESTAMO = 5;
        $prestamo->FECHA_DEVOLUCION = date('Ymd H:i:s');
       
        $material = materialBibliotecario::find($prestamo->ID_MATERIAL);
        $material->DISPONIBLE = true;

        $prestamo->save();
        $material->save();

        activity()->performedOn($prestamo)->log('Finalizó un préstamo ('.$prestamo->id.') ');

    }

    public function prorrogarPrestamo(Request $request)
    {
        $prestamo = Prestamo::find($request->id);
        $prestamo->ID_ESTADO_PRESTAMO = 6;
        
        $fechaInicial = $prestamo->FECHA_ESPERADA_DEVOLUCION;
        $diasProrroga = Configuracion::select('DIAS_PRORROGABLES')->get();
        foreach ($diasProrroga as $dia) {
            $dias = "+ ".(string)$dia->DIAS_PRORROGABLES." days";
        }


        $devolucion = date("d-m-Y",strtotime($prestamo->FECHA_ESPERADA_DEVOLUCION.$dias));

        $prestamo->FECHA_ESPERADA_DEVOLUCION = PrestamosController::verificarDevolucion($devolucion);
       
        $prorroga = new Prorroga();
        $prorroga->FECHA_INICIO = $fechaInicial;
        $prorroga->FECHA_FIN =  $prestamo->FECHA_ESPERADA_DEVOLUCION;
        $prorroga->ID_PRESTAMO =  $prestamo->id;

        $prorroga->save();
        $prestamo->save();

        activity()->performedOn($prestamo)->log('Prorrogó un préstamo ('.$prestamo->id.') ');

    }

    public function penalizarPrestamo(Request $request)
    {
        $prestamo = Prestamo::find($request->id);
        $prestamo->ID_ESTADO_PRESTAMO = 7;

        $penalizacion = new Penalizacion();
        $penalizacion->ID_PRESTAMO = $request->id;
        $penalizacion->SOLVENTADA = false;
        $penalizacion->ID_TIPO_PENALIZACION = $request->tipoPenalizacion;

        $penalizacion->save();
        $prestamo->save();

        $user = User::find( $prestamo->ID_USUARIO );
        $user->notify(new NuevaPenalizacion($prestamo));

        activity()->performedOn($prestamo)->log('Penalizó un préstamo ('.$prestamo->id.') ');

    }

    public function cancelarPrestamo(Request $request)
    {
        $prestamo = Prestamo::find($request->id);
        $prestamo->ID_ESTADO_PRESTAMO = 8;
       
        $material = materialBibliotecario::find($prestamo->ID_MATERIAL);
        $material->DISPONIBLE = true;

        $prestamo->save();
        $material->save();

        activity()->performedOn($prestamo)->log('Canceló un préstamo ('.$prestamo->id.') ');

    }

    public function verificarDevolucion($fecha_devolucion_inicial){

        $devolucion = $fecha_devolucion_inicial;
        
        $hoy = date('Ymd');
        
        $asuetos = DB::table('calendarios')
        ->where('inicio_inactividad', '>=', $hoy )
        ->where('inicio_inactividad', '<', date("d-m-Y",strtotime($hoy."+ 60 days")) )
        ->orderBy('inicio_inactividad', 'asc')
        ->get();
        
        foreach ($asuetos as $key => $asueto) {
            if ($asueto->fin_inactividad == null) {
                if (date("d-m-Y",strtotime($asueto->inicio_inactividad)) == $devolucion) {
                    $devolucion = date("d-m-Y",strtotime($asueto->inicio_inactividad."+ 1 days"));
                }
            }else{
                if 
                (
                    $devolucion >= date("d-m-Y",strtotime($asueto->inicio_inactividad)) && 
                    $devolucion <= date("d-m-Y",strtotime($asueto->fin_inactividad))
                ){
                    $devolucion = date("d-m-Y",strtotime($asueto->fin_inactividad));
                }
            }
           
        }

        return $devolucion;

    }

    public function verAporteOnLine($aporte){
        $aporte_a_enviar = Aporte::find($aporte);
        $aporte_a_enviar->VISTAS += 1;
        $aporte_a_enviar->save();
        return view('Prestamo.verPrestamoOnLine')->with([
            'aporte'=> $aporte_a_enviar,
        ]);
    }
}