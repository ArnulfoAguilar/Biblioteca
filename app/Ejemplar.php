<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ejemplar extends Model
{
    protected $fillable = [
        'NOMBRE', 'DESCRIPCION', 'ISBN', 'AUTOR', 'PAGINAS'
        ];
}
