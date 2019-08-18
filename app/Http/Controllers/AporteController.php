<?php

namespace App\Http\Controllers;

use App\Aporte;
use App\Area;
use App\User;
use Illuminate\Http\Request;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Areas = Area::all();
        return view('Aportes.NuevoAporte')->with(['Areas' => $Areas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /*$detalle=$request->DESCRIPCION;
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
            $path =public_path().'/aportesImages/'. $image_name;
            file_put_contents($path, $data);
            $img->removeattribute('src');
            $img->setattribute('src', urldecode($path));
            
        }
        $detalle = $dom->savehtml();*/

        $detalle=$request->DESCRIPCION;
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
        $Aporte->DESCRIPCION = $detalle;
        $Aporte->PALABRAS_CLAVE = $request->PALABRAS_CLAVE;
        $Aporte->ID_AREA = $request->ID_AREA;
        $Aporte->ID_TIPO_APORTE = 1;
        if($request->customSwitch3 == '' || $request->customSwitch3 == null){
            $Aporte->COMENTARIOS = false;
        }else{
            $Aporte->COMENTARIOS = true;
        }
        
        $Aporte->ID_USUARIO = auth()->id();
        $Aporte->Save();

        return redirect()->route('aportes.show',['aporte' => $Aporte]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aporte  $aporte
     * @return \Illuminate\Http\Response
     */
    public function show(Aporte $aporte)
    {
        //dd($aporte);
        return view('Aportes.verAporte')->with(['aporte' => $aporte]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aporte  $aporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Aporte $aporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aporte  $aporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aporte $aporte)
    {
        //
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
}
