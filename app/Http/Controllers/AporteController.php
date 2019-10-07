<?php

namespace App\Http\Controllers;

use App\Aporte;
use App\AportePalabraClavePivote;
use App\Area;
use App\palabrasClave;
use App\tipoAporte;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use TJGazel\Toastr\Facades\Toastr;

use App\Notifications\NewAporte;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Notification;

class AporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->vista == 2 || $request->vista == '2'){
            return view('Aportes.ListaAporteDirector');
        }else{
            return view('Aportes.ListaAporte')->with([
                'id' => $request->id
                ]);
        }

    }

    public function lista()
    {
        return DB::table('lista_aportes')
        ->where('HABILITADO','=','TRUE')
        ->get();
        /*
        return DB::table('Aporte')
        ->join('users', function($join){
            $join->on('users.id','=','Aporte.ID_USUARIO')
            ->where([
                ['Aporte.HABILITADO','=','1']
            ]);
        })
        ->select('Aporte.id','Aporte.TITULO','Aporte.DESCRIPCION','Aporte.created_at','users.name')
        ->get();*/
    }


    public function listatodos(Request $request)
    {
        return DB::table('lista_aportes')
        ->where('HABILITADO','=','TRUE')
        ->get();
        /*return DB::table('Aporte')
        ->join('users', function($join){
            $join->on('users.id','=','Aporte.ID_USUARIO')
            ->where([
                ['Aporte.HABILITADO','=','1']
            ]);
        })
        ->select('Aporte.id','Aporte.TITULO','Aporte.DESCRIPCION','Aporte.created_at','users.name')
        ->get();*/
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
        return view('Aportes.NuevoAporte')
            ->with(['Areas' => $Areas])
            ->with(['PalabrasClave' => $PalabrasClave])
            ->with(['TipoAportes' => $TipoAportes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $valorMaximoArchivo=3000; // En Kilobytes
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
        }else{
            if($request->ID_TIPO_APORTE==2){
            $validateData = $request->validate([
                'archivo' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:'.$valorMaximoArchivo,
                ],
                [
                    'archivo.required' => 'El archivo es requerido',
                    'archivo.mimetypes' => 'El archivo a anexar debe ser un video',
                    'archivo.max' => 'El archivo no debe ser mayor a '.$valorMaximoArchivo.' kb'
                ]);
            }elseif($request->ID_TIPO_APORTE==3){
                $validateData = $request->validate([
                    'archivo' => 'required|mimes:png,jpeg,jpg|max:'.$valorMaximoArchivo,
                ],
                [
                    'archivo.required' => 'El archivo es requerido',
                    'archivo.mimes' => 'El archivo a anexar debe ser una imagen',
                    'archivo.max' => 'El archivo no debe ser mayor a ' . $valorMaximoArchivo . ' kb'
                ]);
            }else{
                $validateData = $request->validate([
                    'archivo' => 'required|mimetypes:audio/mpeg|max:'.$valorMaximoArchivo,
                ],
                [
                    'archivo.required' => 'El archivo es requerido',
                    'archivo.mimetypes' => 'El archivo a anexar debe ser un audio',
                    'archivo.max' => 'El archivo no debe ser mayor a ' . $valorMaximoArchivo . ' kb'
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
        $TipoAporte = tipoAporte::find($request->ID_TIPO_APORTE);
        $PalabrasClave = DB::table('aportePalabraClavePivote')
                        ->join('palabrasClave', function($join) use ($Aporte) {
                            $join->on('aportePalabraClavePivote.ID_PALABRA_CLAVE','=','palabrasClave.id')
                            ->where('aportePalabraClavePivote.ID_APORTE','=',$Aporte->id);
                        })
                        ->select('palabrasClave.id','palabrasClave.PALABRA')
                        ->get();

            $user = User::all();
            Notification::send($user, new NewAporte($Aporte)); //Esto notifica a varios usuarios

            //activity()->log('Aporte guardado');

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
        return view('Aportes.verAporte')->with(['aporte' => $aporte])
            ->with(['PalabrasClave' => $PalabrasClave])
            ->with(['TipoAporte' => $TipoAporte]);

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
            activity()->log('Aporte habilitado');
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
        $aporte = Aporte::find($id);

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
        ->with(['PalabrasClave' => $PalabrasClave])
        ->with(['aporte' => $aporte])
        ->with(['Areas' => $Areas])
        ->with(['TipoAportes' => $TipoAportes])
        ->with(['TipoAporteSelect' => $TipoAporteSelect])
        ->with(['PalabrasClaveselect' => $PalabrasClaveselect])
        ->with(['AreaSelec' => $AreaSelec]);

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

        $detalle=$request->CONTENIDO;
        $dom = new \domdocument();
        $dom->loadHtml('<?xml encoding="UTF-8">'.$detalle);
        $images = $dom->getelementsbytagname('img');
        foreach($images as $k => $img)
        {
            $data = $img->getattribute('src');
            //dd(count(explode(';', $data)));
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

        $Aporte = Aporte::find($aporteid);
        $Aporte->TITULO = $request->TITULO;
        $Aporte->DESCRIPCION = $request->DESCRIPCION;
        $Aporte->CONTENIDO = $detalle;
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

        activity()->log('Aporte actualizado');

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
