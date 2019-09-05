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

class AporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Aportes.ListaAporte');
    }
    public function lista()
    {   
        return DB::table('Aporte')
        ->join('users', function($join){
            $join->on('users.id','=','Aporte.ID_USUARIO')
            ->where([
                ['Aporte.HABILITADO','=','1']
            ]);
        })
        ->select('Aporte.TITULO','Aporte.DESCRIPCION','Aporte.created_at','users.name')
        ->get();
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
