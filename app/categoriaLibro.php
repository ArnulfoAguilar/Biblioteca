<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categoriaLibro extends Model
{
    protected $table = 'categoriaLibro';
    protected $fillable = [
        'ID_CATEGORIA',
        'CATEGORIA_LIBRO'
    ];
}
