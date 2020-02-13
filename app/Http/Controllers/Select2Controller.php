<?php

namespace App\Http\Controllers;

use App\Idioma;
use App\Modelos\catalogoMaterial;
use App\Modelos\estadoEjemplar;
use App\Modelos\tipoAdquisicion;
use App\Modelos\tipoEmpastado;
use App\tipoPrestamo;
use Illuminate\Http\Request;

class Select2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tipoEmpastadoSelect()
    {
        $empastados = tipoEmpastado::all();

        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' => 'Seleccione',
        ];
        foreach ($empastados as $key => $value) {
            $data[$key + 1] = [
                'id'   => $value->ID_TIPO_EMPASTADO,
                'text' => $value->NOMBRE,
            ];
        }
        return response()->json($data);
    }
    public function tipoAdquisicionSelect()
    {
        $adquisicion = tipoAdquisicion::all();

        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' => 'Seleccione',
        ];
        foreach ($adquisicion as $key => $value) {
            $data[$key + 1] = [
                'id'   => $value->ID_TIPO_ADQUISICION,
                'text' => $value->NOMBRE,
            ];
        }
        return response()->json($data);
    }
    public function estadoEjemplarSelect()
    {
        $estados = estadoEjemplar::all();

        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' => 'Seleccione',
        ];
        foreach ($estados as $key => $value) {
            $data[$key + 1] = [
                'id'   => $value->ID_ESTADO_EJEMPLAR,
                'text' => $value->NOMBRE,
            ];
        }
        return response()->json($data);
    }

    public function idiomaSelect()
    {
        $idioma = Idioma::all();

        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' => 'Seleccione',
        ];
        foreach ($idioma as $key => $value) {
            $data[$key + 1] = [
                'id'   => $value->ID_IDIOMA,
                'text' => $value->IDIOMA,
            ];
        }
        return response()->json($data);
    }

    public function catalogoMaterialSelect()
    {
        $materiales = catalogoMaterial::all();

        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' => 'Seleccione',
        ];
        foreach ($materiales as $key => $value) {
            $data[$key + 1] = [
                'id'   => $value->id,
                'text' => $value->NOMBRE,
            ];
        }
        return response()->json($data);
    }
    public function tipoPrestamoSelect()
    {
        $tipoPrestamos = tipoPrestamo::all();

        $data = [];
        $data[0] = [
            'id'   => 0,
            'text' => 'Seleccione',
        ];
        foreach ($tipoPrestamos as $key => $value) {
            $data[$key + 1] = [
                'id'   => $value->id,
                'text' => $value->TIPO_PRESTAMO,
            ];
        }
        return response()->json($data);
    }
}
