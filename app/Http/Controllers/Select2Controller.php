<?php

namespace App\Http\Controllers;

use App\Modelos\tipoEmpastado;
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
                'id'   => $value->id,
                'text' => $value->NOMBRE,
            ];
        }
        return response()->json($data);
    }
}
