<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $table='Revision';
    protected $fillable =[
        'DETALLE_REVISION',
        'ID_ESTADO_REVISION',
        'ID_COMITE',
        'ID_APORTE',
        'ID_USUARIO'        
    ];
}
