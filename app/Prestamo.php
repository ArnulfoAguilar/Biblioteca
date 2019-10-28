<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table = "Prestamo";
    protected $fillable = [
        'FECHA_PRESTAMO',
        'ID_USUARIO',
        'ID_TIPO_PRESTAMO',
        'ID_ESTADO_PRESTAMO',
        'ID_MATERIAL'

    ];
}
