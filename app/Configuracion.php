<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuraciones';
    protected $fillable = [
        'DIAS_HABILES_PRORROGA',
        'HABILITAR_COMENTARIOS',
        'TAMAÑO_MAXIMO_ARCHIVOS',
        'NOMBRE_INSTITUCION',
        'DIRECCION_INSTITUCION'
    ];

}
