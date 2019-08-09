<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aporte extends Model
{
    protected $table='Aporte';
    protected $fillable =[
        'TITULO',
        'DESCRIPCION',
        'PALABRAS_CLAVE',
        'COMENTARIOS',
        'ID_AREA',
        'ID_TIPO_APORTE',
        'ID_USUARIO'        
    ];
}
