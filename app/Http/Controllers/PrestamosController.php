<?php

namespace App\Http\Controllers;

use App\Modelos\Prestamo;
use App\Modelos\Ejemplar;
use App\tipoPrestamo;
use App\materialBibliotecario;
use App\Prorroga;
use App\Penalizacion;
use App\User;
use App\Configuracion;
use Illuminate\Http\Request;

use DB;

class PrestamosController extends Controller
{
    public function index(Request $request)
    {
        // $prestamos = Prestamo::all();
        // $users = User::all();
        // $estados = tipoPrestamo::all();
        // $materiales = materialBibliotecario::all();
        // $ejemplares = Ejemplar::all();

        $prestamos = DB::table('Prestamo')
        ->select('Prestamo.*', 'Ejemplar.EJEMPLAR', 'estadoPrestamo.ESTADO_PRESTAMO',
        'users.name', 'Ejemplar.AUTOR', 'Ejemplar.EDICION', 'Ejemplar.ID_TIPO_ADQUISICION',
        'tipoAdquisicion.NOMBRE as tipoAdquisicion', 'tipoPrestamo.TIPO_PRESTAMO as tipoPrestamo'
         )
        ->join('materialBibliotecario', 'materialBibliotecario.id', '=', 'Prestamo.ID_MATERIAL')
        ->join('Ejemplar', 'Ejemplar.id', '=', 'materialBibliotecario.ID_EJEMPLAR')
        ->join('estadoPrestamo', 'estadoPrestamo.id', '=', 'Prestamo.ID_ESTADO_PRESTAMO')
        ->join('tipoAdquisicion', 'tipoAdquisicion.ID_TIPO_ADQUISICION', '=', 'Ejemplar.ID_TIPO_ADQUISICION')
        ->join('users', 'users.id', '=', 'Prestamo.ID_USUARIO')
        ->leftjoin('tipoPrestamo', 'tipoPrestamo.id', '=', 'Prestamo.ID_TIPO_PRESTAMO')
        ->paginate(10);

        $tiposPrestamos = tipoPrestamo::all();

        return view('Prestamo.prestamos')->with([
            'prestamos'=> $prestamos,
            'tiposPrestamos'=> $tiposPrestamos,
            // 'users'=> $users,
            // 'estados'=> $estados,
            // 'materiales'=> $materiales,
            // 'ejemplares'=> $ejemplares,
        ]);
    }

    public function misPrestamos(Request $request)
    {
        $prestamos = Prestamo::where('ID_USUARIO', auth()->id())->orderBy('created_at', 'asc')->get();

        return view('Prestamo.misPrestamos')->with([
            'prestamos'=> $prestamos,
        ]);
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

        $prestamo->FECHA_ESPERADA_DEVOLUCION = date("d-m-Y",strtotime($prestamo->FECHA_PRESTAMO.$dias));

       
        $material = materialBibliotecario::find($prestamo->ID_MATERIAL);
        $material->DISPONIBLE = false;

        $prestamo->save();
        $material->save();
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

        $prestamo->FECHA_ESPERADA_DEVOLUCION = date("d-m-Y",strtotime($fechaInicial.$dias));

        $prorroga = new Prorroga();
        $prorroga->FECHA_INICIO = $fechaInicial;
        $prorroga->FECHA_FIN =  $prestamo->FECHA_ESPERADA_DEVOLUCION;
        $prorroga->ID_PRESTAMO =  $prestamo->id;

        $prorroga->save();
        $prestamo->save();
    }

    public function penalizarPrestamo(Request $request)
    {
        $prestamo = Prestamo::find($request->id);
        $prestamo->ID_ESTADO_PRESTAMO = 7;

        $penalizacion = new Penalizacion();
        $penalizacion->ID_PRESTAMO = $request->id;

        $penalizacion->save();
        $prestamo->save();
    }
}