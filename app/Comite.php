<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comite extends Model
{
    protected $table='Comite';
    protected $fillable =[
        'COMITE',
        'ID_AREA'        
    ];
}
