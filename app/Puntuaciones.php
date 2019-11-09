<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puntuaciones extends Model
{
    protected $table = "Puntuacion";
    protected $fillable = [
        'PUNTUACION',
        'VALOR'
    ];
}
