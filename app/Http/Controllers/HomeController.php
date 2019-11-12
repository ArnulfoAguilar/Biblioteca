<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

//use Spatie\Activitylog\Models\Activity;

class HomeController extends Controller
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
    public function index()
    {
        $hoy = date("d-m-Y");
        $antes = date("d-m-Y",strtotime($hoy."- 7 days"));

        $habilitados = DB::table('Aporte')->where('HABILITADO', true)->count();
        $pendientes = DB::table('Aporte')->where('HABILITADO', false)->count();
        $sugerencias = DB::table('Adquisicion')->where('created_at', '>', $antes)->count();
        $aportes = DB::table('Aporte')->where('created_at', '>', $antes)->count();
        $prestamos = DB::table('Prestamo')->where('ID_ESTADO_PRESTAMO', '!=', 5)->count();

        return view('home')->with([
            'habilitados' => $habilitados,
            'pendientes' => $pendientes,
            'sugerencias' => $sugerencias,
            'aportes' => $aportes,
            'prestamos' => $prestamos,
        ]);
    }

    public function busqueda()
    {
        return view('busqueda');
    }

    public function listaEjemplares()
    {
        return view('lista-ejemplares');
    }

    public function busquedaLibro(){
        return view('buscar-libro');
    }

    public function roles(){
        return view('roles');
    }

    public function adquisiciones(){
        return view('Adquisicion/listaadquisiciones');
    }

    public function marcarLeidas(){
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
    }
    
    public function prestamos()
    {
        return view('Prestamo/prestamo');
    }
}
