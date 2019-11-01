<?php

namespace App\Http\Controllers;

use App\Modelos\Prestamo;
use App\Modelos\Ejemplar;
use App\tipoPrestamo;
use App\materialBibliotecario;
use App\User;
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
        ->select('Prestamo.*', 'Ejemplar.EJEMPLAR', 'estadoPrestamo.ESTADO_PRESTAMO', 'users.name' )
        ->join('materialBibliotecario', 'materialBibliotecario.id', '=', 'Prestamo.ID_MATERIAL')
        ->join('Ejemplar', 'Ejemplar.id', '=', 'materialBibliotecario.ID_EJEMPLAR')
        ->join('estadoPrestamo', 'estadoPrestamo.id', '=', 'Prestamo.ID_ESTADO_PRESTAMO')
        ->join('users', 'users.id', '=', 'Prestamo.ID_USUARIO')
        ->paginate(10);



        return view('Prestamo.prestamos')->with([
            'prestamos'=> $prestamos,
            // 'users'=> $users,
            // 'estados'=> $estados,
            // 'materiales'=> $materiales,
            // 'ejemplares'=> $ejemplares,
        ]);
    }

    public function aprobarPrestamo(Request $request)
    {
        $prestamo = Prestamo::find($request->id);
        $prestamo->ID_ESTADO_PRESTAMO = 3;
       
        $material = materialBibliotecario::find($prestamo->ID_MATERIAL);
        $material->DISPONIBLE = false;

        dd($prestamo, $material);

        $prestamo->save();
        $material->save();
    }
}