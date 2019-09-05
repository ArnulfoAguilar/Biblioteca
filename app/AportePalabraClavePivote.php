<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AportePalabraClavePivote extends Model
{
    protected $table='aportePalabraClavePivote';
    protected $fillable=[
        'ID_APORTE',
        'ID_PALABRA_CLAVE'
    ];
}
