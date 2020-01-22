<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        if($request->ajax()){
            return User::all();
        }else{
            return redirect()->route('home');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Usuario = User::find($id);
        if($Usuario==null){
            abort(404);
        }
        
        return view('Usuarios.verUsuario')
        ->with([
            'usuario' => $Usuario
            ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function asignarRol(Request $request)
    {
        $usuario = User::find($request->id);
        $usuario->ID_ROL = $request->ID_ROL;
        $usuario->save();
        activity()->log('Asignó rol a usuario');
        return redirect()->route('asignar.roles');
    }


    public function asignarComite(Request $request)
    {
        $usuario = User::find($request->id);
        $usuario->ID_COMITE = $request->ID_COMITE;
        $usuario->save();
        activity()->log('Asignó departamento a usuario');
        return redirect()->route('asignar.comites');
    }

    public function totalAportesCreados($UsuarioId)
    {
        $AportesRealizados = DB::table('Aporte')
        ->where('ID_USUARIO','=',$UsuarioId)
        ->count();  
        return $AportesRealizados;

    }

    public function obtenerUsuarios(){
        return User::where('ID_ROL', '!=', '2')
        ->where('ID_ROL', '!=', '1')
        ->get();
    }

    public function getUsuarios(){
        $users = User::orderBy('id', 'asc')->get();
        return view('administracion.puntajes')->with([
            'users' => $users,
        ]);
    }

    public function gestionUsuarios(){
        $users = User::orderBy('id', 'asc')->get();
        return view('administracion.usuarios')->with([
            'users' => $users,
        ]);
    }

    public function editarUsuario($user = null){
        if($user){
            $user = User::find($user);
        }
        return view('administracion.usuario-edit')->with([
            'user' => $user,
        ]); 
    }

    public function editarUsuarioPost(Request $request){
        

        $user = User::find($request->id);
        $user->name = $request->nombres; 
        $user->apellidos = $request->apellidos;
        if($user->email != $request->email){
            $user_existente = User::where('email', $request->email);
            if($user_existente->count() > 0 ){
                return back()->with('error', 'El Email digitado <<'.$request->email.'>> ya existe para otro usuario');
            }
        }
        
        $user->email = $request->email; 
        $user->carnet = $request->carnet; 
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return back()->with('success', 'Usuario editado correctamente');
         
    }

    public function guardarUsuario(Request $request){
        $user_existente = User::where('email', $request->email);
        if($user_existente->count() > 0 ){
            return back()->with('error', 'El Email digitado <<'.$request->email.'>> ya existe para otro usuario');
        }

        $user = new User();
        $user->name = $request->nombres; 
        $user->apellidos = $request->apellidos; 
        $user->email = $request->email; 
        $user->carnet = $request->carnet;
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }else{
            $user->password = Hash::make('12345678');
        }
        $user->save();

        return back()->with('success', 'Usuario guardado correctamente');
         
    }
}
