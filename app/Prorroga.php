<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prorroga extends Model
{
    protected $table="Prorroga";
    protected $primaryKey = 'id';
    protected $fillable =[
        'FECHA_INICIO',
        'FECHA_FIN',
        'ID_PRESTAMO'       
    ];
}
