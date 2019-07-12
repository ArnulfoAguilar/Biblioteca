<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'Autor';
    protected $fillable = [
        'ID_AUTOR',
        'AUTOR',
        'DESCRIPCION'
    ];
}
