<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ejemplar extends Model
{
    protected $table = 'Ejemplar';
    protected $fillable = [
        'ISBN',
        'EJEMPLAR',
        'IMAGEN',
        'DESCRIPCION',
        'PALABRAS_CLAVE',
        'NUMERO_PAGINAS',
        'NUMERO_COPIAS',
        'ID_AUTOR',
        'ID_CATEGORIA',
        'ID_TERCER_SUMARIO',
        ];
}
