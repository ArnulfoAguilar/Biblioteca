<?php

namespace App\Http\Controllers;

use App\Aporte;
use App\AportePalabraClavePivote;
use App\Area;
use App\palabrasClave;
use App\tipoAporte;
use App\User;
use App\Comentario;
use App\Puntuaciones;
use App\Niveles;
use App\Modelos\Prestamo;


use App\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use TJGazel\Toastr\Facades\Toastr;

use App\Notifications\NewAporte;
use App\Notifications\AporteModificado;

use App\Mail\Notificacion;//usado para los emails
use Illuminate\Support\Facades\Mail;//usado para los emails

use FontLib\Table\Type\name;

use Illuminate\Support\Facades\Notification;

use Auth;

class AporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            return view('Aportes.ListaAporte')
            ->with([ 'id' => $request->id]);
    }
    public function GetVistaAportesDirector(Request $request){
        return view('Aportes.ListaAporteDirector');
    }
    public function GetMisAportesAprobados(Request $request)
    {
            return view('Aportes.MisAportesAprobados');
    }
    public function GetMisAportesSinAprobar(Request $request)
    {
            return view('Aportes.MisAportesSinAprobar');
    }
    public function GetAportesArea(Request $request)
    {
            return view('Aportes.AportesArea');
    }


    public function listatodos(Request $request)
    {
       
            return DB::table('lista_aportes')
            ->where('HABILITADO','=','TRUE')
            ->latest()
            ->get();
       
    }
    public function listaMisAportesSinAprobar(Request $request)
    {
            return DB::table('lista_aportes')
            ->where([
                ['HABILITADO','=','FALSE'],
                ['ID_AUTOR','=',auth()->id()]
            ])
            ->latest()
            ->get();
    }
    public function listaMisAportesAprobados(Request $request)
    {
        
            return DB::table('lista_aportes')
            ->where([
                ['HABILITADO','=','TRUE'],
                ['ID_AUTOR','=',auth()->id()]
            ])
            ->latest()
            ->get();
    }
    public function listaAportesArea(Request $request)
    {
        
            return DB::table('lista_aportes')
            ->where([
                ['ID_AREA','=', Auth::user()->ID_COMITE],
            ])
            ->latest()
            ->get();
    }
    public function aportesProfile(Request $request)
    {
        
            return DB::table('lista_aportes')
            ->where([
                ['HABILITADO','=','TRUE'],
                ['ID_AUTOR','=',$request->id]
            ])
            ->latest()
            ->get();
    }

    public function listaDirector(Request $request)
    {
        return Aporte::orderBy('created_at', 'desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Areas = Area::all();
        $TipoAportes = tipoAporte::all();
        $PalabrasClave = palabrasClave::all();
        $TamañoMaximoArchivo= Configuracion::select('TAMAÑO_MAXIMO_ARCHIVOS')
                                            ->first();
        return view('Aportes.NuevoAporte')
            ->with(['Areas' => $Areas])
            ->with(['PalabrasClave' => $PalabrasClave])
            ->with(['TipoAportes' => $TipoAportes])
            ->with(['TamañoMaximoArchivo'=>$TamañoMaximoArchivo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $valorMaximoArchivo= Configuracion::select('TAMAÑO_MAXIMO_ARCHIVOS')
                                            ->first();
        if($request->ID_TIPO_APORTE==1){
            $detalle=$request->CONTENIDO;
            $dom = new \domdocument();
            $dom->loadHtml('<?xml encoding="UTF-8">'.$detalle);
            $images = $dom->getelementsbytagname('img');
            foreach($images as $k => $img)
            {
                $data = $img->getattribute('src');
                list($type, $data) = explode(';', $data);
                list(, $data)= explode(',', $data);
                $data = base64_decode($data);
                $image_name= auth()->id().time().$k.'.png';
                $path = public_path().'/aportesImages/'. $image_name;
                file_put_contents($path, $data);
                $img->removeattribute('src');
                $img->setattribute('src', "/aportesImages/". $image_name);
            }
            $detalle = $dom->savehtml();
        //Actualizar puntuacion Aporte escrito//
        $Puntuaciones = Puntuaciones::find(3);
        $Usuario = User::find(auth()->id());
        $Usuario->PUNTOS += $Puntuaciones->VALOR;
        $Niveles = Niveles::all();
        foreach ($Niveles as $nivel) {
         
            if($Usuario->PUNTOS >= $nivel->PUNTAJE_MINIMO){
                 $Usuario->ID_NIVEL = $nivel->id;
            }
        }
        $Usuario->save();
        //Actualizar puntuacion Aporte escrito//  
        }else{
            if($request->ID_TIPO_APORTE==2){
            $validateData = $request->validate([
                'archivo' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:'.$valorMaximoArchivo->TAMAÑO_MAXIMO_ARCHIVOS,
                ],
                [
                    'archivo.required' => 'El archivo es requerido',
                    'archivo.mimetypes' => 'El archivo a anexar debe ser un video',
                    'archivo.max' => 'El archivo no debe ser mayor a '.$valorMaximoArchivo->TAMAÑO_MAXIMO_ARCHIVOS.' kb'
                ]);
                //Actualizar puntuacion Aporte Video//
                $Puntuaciones = Puntuaciones::find(4);
                $Usuario = User::find(auth()->id());
                $Usuario->PUNTOS += $Puntuaciones->VALOR;
                $Niveles = Niveles::all();
                foreach ($Niveles as $nivel) {
                 
                    if($Usuario->PUNTOS >= $nivel->PUNTAJE_MINIMO){
                         $Usuario->ID_NIVEL = $nivel->id;
                    }
                }
                $Usuario->save();
                //Actualizar puntuacion Aporte Video//  
            }elseif($request->ID_TIPO_APORTE==3){
                $validateData = $request->validate([
                    'archivo' => 'required|mimes:png,jpeg,jpg|max:'.$valorMaximoArchivo->TAMAÑO_MAXIMO_ARCHIVOS,
                ],
                [
                    'archivo.required' => 'El archivo es requerido',
                    'archivo.mimes' => 'El archivo a anexar debe ser una imagen',
                    'archivo.max' => 'El archivo no debe ser mayor a ' . $valorMaximoArchivo->TAMAÑO_MAXIMO_ARCHIVOS . ' kb'
                ]);
                //Actualizar puntuacion Aporte Pintura//
                $Puntuaciones = Puntuaciones::find(5);
                $Usuario = User::find(auth()->id());
                $Usuario->PUNTOS += $Puntuaciones->VALOR;
                $Niveles = Niveles::all();
                foreach ($Niveles as $nivel) {
                 
                    if($Usuario->PUNTOS >= $nivel->PUNTAJE_MINIMO){
                         $Usuario->ID_NIVEL = $nivel->id;
                    }
                }
                $Usuario->save();
                //Actualizar puntuacion Aporte Pintura//
            }else{
                $validateData = $request->validate([
                    'archivo' => 'required|mimetypes:audio/mpeg|max:'.$valorMaximoArchivo->TAMAÑO_MAXIMO_ARCHIVOS,
                ],
                [
                    'archivo.required' => 'El archivo es requerido',
                    'archivo.mimetypes' => 'El archivo a anexar debe ser un audio',
                    'archivo.max' => 'El archivo no debe ser mayor a ' . $valorMaximoArchivo->TAMAÑO_MAXIMO_ARCHIVOS . ' kb'
                ]
            );
            //Actualizar puntuacion Aporte Musica//
            $Puntuaciones = Puntuaciones::find(6);
            $Usuario = User::find(auth()->id());
            $Usuario->PUNTOS += $Puntuaciones->VALOR;
            $Niveles = Niveles::all();
            foreach ($Niveles as $nivel) {
             
                if($Usuario->PUNTOS >= $nivel->PUNTAJE_MINIMO){
                     $Usuario->ID_NIVEL = $nivel->id;
                }
            }
            $Usuario->save();
            
            //Actualizar puntuacion Aporte Musica//
            }
           if($request->hasFile('archivo')){

                $file = $request->file('archivo');
                $name = auth()->id().time().$file->getClientOriginalName();
                $file->move(public_path().'/aportesArchivos/', $name);

            }
            $detalle = '/aportesArchivos/'.$name;
        }
        $Aporte = new Aporte();
        $Aporte->TITULO = $request->TITULO;
        $Aporte->DESCRIPCION = $request->DESCRIPCION;
        $Aporte->CONTENIDO = $detalle;
        $Aporte->ID_AREA = $request->ID_AREA;
        $Aporte->ID_TIPO_APORTE = $request->ID_TIPO_APORTE;
        if($request->customSwitch3 == '' || $request->customSwitch3 == null){
            $Aporte->COMENTARIOS = false;
        }else{
            $Aporte->COMENTARIOS = true;
        }
        $Aporte->ID_USUARIO = auth()->id();
        $Aporte->Save();
        foreach ($request->PALABRAS_CLAVE as $key => $value) {
            $pivote = new AportePalabraClavePivote();
            $pivote->ID_APORTE = $Aporte->id;
            $pivote->ID_PALABRA_CLAVE = $value;
            $pivote->Save();
        }
        //Actualizar puntuacion//
        $Puntuaciones = Puntuaciones::find(3);
        // dd($Puntuaciones);
        $Usuario = User::find(auth()->id());
        $Usuario->PUNTOS += $Puntuaciones->VALOR;
        $Niveles = Niveles::all();
        foreach ($Niveles as $nivel) {
         
            if($Usuario->PUNTOS >= $nivel->PUNTAJE_MINIMO){
                 $Usuario->ID_NIVEL = $nivel->id;
            }
        }
        $Usuario->save();

        //Actualizar puntuacion//
        $TipoAporte = tipoAporte::find($request->ID_TIPO_APORTE);
        $PalabrasClave = DB::table('aportePalabraClavePivote')
                        ->join('palabrasClave', function($join) use ($Aporte) {
                            $join->on('aportePalabraClavePivote.ID_PALABRA_CLAVE','=','palabrasClave.id')
                            ->where('aportePalabraClavePivote.ID_APORTE','=',$Aporte->id);
                        })
                        ->select('palabrasClave.id','palabrasClave.PALABRA')
                        ->get();

            $users = User::where('ID_COMITE', $request->ID_AREA)->orWhere('ID_ROL', 1)->get();//Trae lo usuarios pertenecientes al area y a los admin
            Notification::send($users, new NewAporte($Aporte)); //Esto notifica a varios usuarios
            
            
            activity()->performedOn($Aporte)->log('Aporte guardado ('.$Aporte->TITULO.')');

            return redirect()->route('aportes.show',['aporte' => $Aporte])
            ->with(['PalabrasClave' => $PalabrasClave])
            ->with(['TipoAporte' => $TipoAporte]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aporte  $aporte
     * @return \Illuminate\Http\Response
     */
    public function show_backup(Aporte $aporte)
    {

        $PalabrasClave = DB::table('aportePalabraClavePivote')
        ->join('palabrasClave', function($join) use ($aporte) {
            $join->on('aportePalabraClavePivote.ID_PALABRA_CLAVE','=','palabrasClave.id')
            ->where('aportePalabraClavePivote.ID_APORTE','=',$aporte->id);
        })
        ->select('palabrasClave.id','palabrasClave.PALABRA')
        ->get();
        $PermiteComentarios= Configuracion::select('HABILITAR_COMENTARIOS')
                                            ->first();
        $TipoAporte = tipoAporte::find($aporte->ID_TIPO_APORTE);
        return view('Aportes.verAporte')->with(['aporte' => $aporte])
            ->with(['PalabrasClave' => $PalabrasClave])
            ->with(['TipoAporte' => $TipoAporte])
            ->with(['PermiteComentarios'=>$PermiteComentarios]);

    }

    public function show(Aporte $aporte)
    {

        $PalabrasClave = DB::table('aportePalabraClavePivote')
        ->join('palabrasClave', function($join) use ($aporte) {
            $join->on('aportePalabraClavePivote.ID_PALABRA_CLAVE','=','palabrasClave.id')
            ->where('aportePalabraClavePivote.ID_APORTE','=',$aporte->id);
        })
        ->select('palabrasClave.id','palabrasClave.PALABRA')
        ->get();
        $TipoAporte = tipoAporte::find($aporte->ID_TIPO_APORTE);
        
        $interacciones = Comentario::select('Comentario.id as id_comentario', 'interaccionComentario.id as id_interaccion')
        ->join('interaccionComentario', 'Comentario.id', '=', 'interaccionComentario.ID_COMENTARIO')
        ->where('interaccionComentario.ID_USUARIO', '=', auth()->id() )
        ->get();

        $comentarios = DB::table('comentarioslikes')
        ->where('ID_APORTE', $aporte->id)
        ->where('HABILITADO', true)->get();

        $PermiteComentarios= Configuracion::select('HABILITAR_COMENTARIOS')->first();

        //Actualizar puntuacion//
        $Puntuaciones = Puntuaciones::find(1);
        $Usuario = User::find(auth()->id());
        $Usuario->PUNTOS += $Puntuaciones->VALOR;
        $Niveles = Niveles::all();
           foreach ($Niveles as $nivel) {
            
               if($Usuario->PUNTOS >= $nivel->PUNTAJE_MINIMO){
                    $Usuario->ID_NIVEL = $nivel->id;
               }
           }
        $Usuario->save();
        //Actualizar puntuacion//      

        return view('Aportes.verAporte')
        ->with([
            'aporte' => $aporte,
            'PalabrasClave' => $PalabrasClave,
            'TipoAporte' => $TipoAporte,
            'interacciones' => $interacciones,
            'comentarios' => $comentarios,
            'PermiteComentarios'=> $PermiteComentarios
            // 'malasPalabras' => $malasPalabras
            ]);
            

    }

    public function habilitar(Request $request){

        $aporte = Aporte::find($request->id);
        $revisiones = $aporte->revisiones;
        $solventado_total=true;
        foreach ($revisiones as $key => $revision) {
            if($revision->estadoRevision->ESTADO_REVISION != 'Solventada')
            {
                $solventado_total = false;
            }
        }
        if($solventado_total == true)
        {
            $aporte->HABILITADO = true;
            $aporte->save();
            activity()->performedOn($aporte)->log('Aporte habilitado ('.$aporte->TITULO.')');
              //Actualizar puntuacion Habilitar aporte//
            $Puntuaciones = Puntuaciones::find(8);
            $Niveles = Niveles::all();
            $Usuario = User::find($aporte->ID_USUARIO);
            $Usuario->PUNTOS += $Puntuaciones->VALOR;
            $Niveles = Niveles::all();
            foreach ($Niveles as $nivel) {
             
                if($Usuario->PUNTOS >= $nivel->PUNTAJE_MINIMO){
                     $Usuario->ID_NIVEL = $nivel->id;
                }
            }
            $Usuario->save();
            //Actualizar puntuacion habilitar aporte// 
            return '1';
        }else{
            return '0';
        }

    }


    public function showAporteToDirector(Aporte $aporte)
    {

        $PalabrasClave = DB::table('aportePalabraClavePivote')
        ->join('palabrasClave', function($join) use ($aporte) {
            $join->on('aportePalabraClavePivote.ID_PALABRA_CLAVE','=','palabrasClave.id')
            ->where('aportePalabraClavePivote.ID_APORTE','=',$aporte->id);
        })
        ->select('palabrasClave.id','palabrasClave.PALABRA')
        ->get();
        $TipoAporte = tipoAporte::find($aporte->ID_TIPO_APORTE);
        return view('Aportes.verAporteDirector')->with(['aporte' => $aporte])
            ->with(['PalabrasClave' => $PalabrasClave])
            ->with(['TipoAporte' => $TipoAporte]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aporte  $aporte
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $TamañoMaximoArchivo= Configuracion::select('TAMAÑO_MAXIMO_ARCHIVOS')
                                            ->first();
                                            // dd($TamañoMaximoArchivo);
        $aporte = Aporte::find($id);
        if($aporte->ID_USUARIO==auth()->id()){
            $Areas = Area::all();
            $TipoAportes=tipoAporte::all();
            $PalabrasClave = palabrasClave::all();
            $PalabrasClaveselect = DB::table('aportePalabraClavePivote')
            ->join('palabrasClave', function($join) use ($aporte) {
                $join->on('aportePalabraClavePivote.ID_PALABRA_CLAVE','=','palabrasClave.id')
                ->where('aportePalabraClavePivote.ID_APORTE','=',$aporte->id);
            })
            ->select('palabrasClave.id')
            
            ->get();
            $AreaSelec = Area::find($aporte->ID_AREA);
            $TipoAporteSelect = tipoAporte::find($aporte->ID_TIPO_APORTE);
            
            return view('Aportes.editarAporte')
            ->with([
                'PalabrasClave' => $PalabrasClave,
                'aporte' => $aporte,
                'Areas' => $Areas,
                'TipoAportes' => $TipoAportes,
                'TipoAporteSelect' => $TipoAporteSelect,
                'PalabrasClaveselect' => $PalabrasClaveselect,
                'AreaSelec' => $AreaSelec,
                'TamañoMaximoArchivo' => $TamañoMaximoArchivo,
            ]);
        }else {
            abort(403);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aporte  $aporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $aporteid)
    {
        
        $valorMaximoArchivo= Configuracion::select('TAMAÑO_MAXIMO_ARCHIVOS')
        ->first();
        $detalle = null;
        if($request->ID_TIPO_APORTE==1){
            
        $detalle=$request->CONTENIDO;
        $dom = new \domdocument();
        $dom->loadHtml('<?xml encoding="UTF-8">'.$detalle);
        $images = $dom->getelementsbytagname('img');
        foreach($images as $k => $img)
        {
            $data = $img->getattribute('src');
            if (count(explode(';', $data)) == 1) {
                //si entra aqui es porque ya existe la
                //imagen en el servidor asi que la saltara
            }else {
                list($type, $data) = explode(';', $data);
                list(, $data)= explode(',', $data);
                $data = base64_decode($data);
                $image_name= auth()->id().time().$k.'.png';
                $path = public_path().'/aportesImages/'. $image_name;
                file_put_contents($path, $data);
                $img->removeattribute('src');
                $img->setattribute('src', "/aportesImages/". $image_name);
            }
        }
        $detalle = $dom->savehtml();
    }else{
        
        
    if($request->archivo!=null){
        
        if($request->ID_TIPO_APORTE==2){
            
        $validateData = $request->validate([
            'archivo' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:'.$valorMaximoArchivo,
            ],
            [
                'archivo.required' => 'El archivo es requerido',
                'archivo.mimetypes' => 'El archivo a anexar debe ser un video',
                'archivo.max' => 'El archivo no debe ser mayor a '.$valorMaximoArchivo->TAMAÑO_MAXIMO_ARCHIVOS.' kb'
            ]);
        }elseif($request->ID_TIPO_APORTE==3){
            
            $validateData = $request->validate([
                'archivo' => 'required|mimes:png,jpeg,jpg|max:'.$valorMaximoArchivo->TAMAÑO_MAXIMO_ARCHIVOS,
            ],
            [
                'archivo.required' => 'El archivo es requerido',
                'archivo.mimes' => 'El archivo a anexar debe ser una imagen',
                'archivo.max' => 'El archivo no debe ser mayor a ' . $valorMaximoArchivo->TAMAÑO_MAXIMO_ARCHIVOS . ' kb'
            ]);
        }else{
            $validateData = $request->validate([
                'archivo' => 'required|mimetypes:audio/mpeg|max:'.$valorMaximoArchivo->TAMAÑO_MAXIMO_ARCHIVOS,
            ],
            [
                'archivo.required' => 'El archivo es requerido',
                'archivo.mimetypes' => 'El archivo a anexar debe ser un audio',
                'archivo.max' => 'El archivo no debe ser mayor a ' . $valorMaximoArchivo->TAMAÑO_MAXIMO_ARCHIVOS . ' kb'
            ]
        );
        }
        
       if($request->hasFile('archivo')){

            $file = $request->file('archivo');
            $name = auth()->id().time().$file->getClientOriginalName();
            
            $file->move(public_path().'/aportesArchivos/', $name);

        }
        $detalle = '/aportesArchivos/'.$name;
    }
    }

        $Aporte = Aporte::find($aporteid);
        $Aporte->TITULO = $request->TITULO;
        $Aporte->DESCRIPCION = $request->DESCRIPCION;
        if ($detalle !=null) {
            
            $Aporte->CONTENIDO = $detalle;
        }
        
        if ($request->ID_AREA != null) {
            $Aporte->ID_AREA = $request->ID_AREA;
        }
        if ($request->ID_TIPO_APORTE != null) {
        $Aporte->ID_TIPO_APORTE = $request->ID_TIPO_APORTE;
        }
        if($request->customSwitch3 == '' || $request->customSwitch3 == null){
            $Aporte->COMENTARIOS = false;
        }else{
            $Aporte->COMENTARIOS = true;
        }
        $Aporte->Save();

        $registros = AportePalabraClavePivote::where('ID_APORTE','=',$Aporte->id)
        ->select('id')
        ->get()->toArray();
        AportePalabraClavePivote::destroy($registros);

        foreach ($request->PALABRAS_CLAVE as $key => $value) {
            $pivote = new AportePalabraClavePivote();
            $pivote->ID_APORTE = $Aporte->id;
            $pivote->ID_PALABRA_CLAVE = $value;
            $pivote->Save();
        }

        $TipoAporte = tipoAporte::find($request->ID_TIPO_APORTE);
        $PalabrasClave = DB::table('aportePalabraClavePivote')
                        ->join('palabrasClave', function($join) use ($Aporte) {
                            $join->on('aportePalabraClavePivote.ID_PALABRA_CLAVE','=','palabrasClave.id')
                            ->where('aportePalabraClavePivote.ID_APORTE','=',$Aporte->id);
                        })
                        ->select('palabrasClave.id','palabrasClave.PALABRA')
                        ->get();

        $users = User::where('ID_COMITE', $request->ID_AREA)->orWhere('ID_ROL', 1)->get();//Trae lo usuarios pertenecientes al area y a los admin
        Notification::send($users, new AporteModificado($Aporte)); //Esto notifica a varios usuarios
        activity()->performedOn($Aporte)->log('Aporte actualizado ('.$Aporte->TITULO.')');

            return redirect()->route('aportes.show',['aporte' => $Aporte])
            ->with(['PalabrasClave' => $PalabrasClave])
            ->with(['TipoAporte' => $TipoAporte]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aporte  $aporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aporte $aporte)
    {
        //
    }

    public function obtener(Request $request)
    {
        return Aporte::where('id', $request->id)->get();
    }
}
