<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class filaEstante extends Model
{
    protected $table = 'filaEstante';
    protected $fillable = [
        'FILA_ESTANTE',
        'ID_BIBLIOTECA',
        'ID_ESTANTE'
    ];
}
