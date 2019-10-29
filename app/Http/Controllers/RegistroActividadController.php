<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\DB;
use App\User;
use Response;

class RegistroActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->fecha_i == null && $request->fecha_f == null ){
            $registros = DB::table('activity_log')->orderBy('created_at', 'DESC')->paginate(10);
        }elseif ($request->fecha_i != null && $request->fecha_f != null) {
            $registros = DB::table('activity_log')
            ->where('created_at', '>=', $request->fecha_i)
            ->where('created_at', '<=', $request->fecha_f)
            ->orderBy('created_at', 'DESC')->paginate(10);
        }
        else {
            if($request->fecha_f == null){
                $registros = DB::table('activity_log')
                ->where('created_at', '>=',  $request->fecha_i)
                ->orderBy('created_at', 'DESC')->paginate(10);
            }elseif ($request->fecha_i == null) {
                $registros = DB::table('activity_log')
                ->where('created_at', '<=',  $request->fecha_f)
                ->orderBy('created_at', 'DESC')->paginate(10);
            }else{
                $registros = DB::table('activity_log')
                ->orderBy('created_at', 'DESC')->paginate(10);
            }
        }
 
        $users = User::all();

        return view('administracion.registro')
        ->with([ 
            'registros' => $registros,
            'users' => $users,
            'fecha_i'=> $request->fecha_i,
            'fecha_f'=> $request->fecha_f,
            ]);
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

    public function downloadTxt(Request $request) {

        if($request->fecha_i == null && $request->fecha_f == null ){
            $logs = DB::table('activity_log')->orderBy('created_at', 'DESC')->paginate(10);
            $content = "Todos los registros \n";
            $fileName = "Logs.txt";
        }elseif ($request->fecha_i != null && $request->fecha_f != null) {
            $logs = DB::table('activity_log')
            ->where('created_at', '>=', $request->fecha_i)
            ->where('created_at', '<=', $request->fecha_f)
            ->orderBy('created_at', 'DESC')->paginate(10);
            $content = "Registros desde: ".$request->fecha_i." Hasta:".$request->fecha_f." \n";
            $fileName = "Logs desde: ".$request->fecha_i." Hasta:".$request->fecha_f.".txt";

        }
        else {
            if($request->fecha_f == null){
                $logs = DB::table('activity_log')
                ->where('created_at', '>=',  $request->fecha_i)
                ->orderBy('created_at', 'DESC')->paginate(10);
                $content = "Registros desde: ".$request->fecha_i." \n";
                $fileName = "Logs desde: ".$request->fecha_i.".txt";
            }elseif ($request->fecha_i == null) {
                $logs = DB::table('activity_log')
                ->where('created_at', '<=',  $request->fecha_f)
                ->orderBy('created_at', 'DESC')->paginate(10);
                $content = "Registros Hasta:".$request->fecha_f." \n";
                $fileName = "Logs Hasta:".$request->fecha_f.".txt";
            }else{
                $logs = DB::table('activity_log')
                ->orderBy('created_at', 'DESC')->paginate(10);
                $content = "Todos los registros \n";
                $fileName = "Logs.txt";
            }
        }

        $users = User::all();
        $found = false;

        foreach ($logs as $log) {
            $content .= $log->id;
            $content .= ' | ';
            foreach ($users as $key => $user) {
                if($user->id == $log->causer_id){
                $content .= $user->name;
                $found = true;
                }
            }
            if($found==false){
                $content .= '<<Usuario no encontrado>>';
            }
            $content .= ' | ';
            $content .= $log->description;
            $content .= ' | Fecha: ';
            $content .= $log->created_at;
            $content .= "\n";
        }
        
        // use headers in order to generate the download
        $headers = [
          'Content-type' => 'text/plain', 
          'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName),
        //   'Content-Length' => sizeof($content)
        ];
        // make a response, with the content, a 200 response code and the headers
        return Response::make($content, 200, $headers);
    }
}
