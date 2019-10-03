<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adquisicion extends Model
{
    protected $table='Adquisicion';
    protected $fillable =[
        'TITULO',
        'DESCRIPCION',
        'CONTENIDO',
        'ID_AREA',
        'ID_USUARIO'        
    ];
}
