<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
        activity()->log('Show home')->subject(1);
        return view('home');
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
}
