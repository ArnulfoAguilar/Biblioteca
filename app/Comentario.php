<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'Comentario';
    protected $fillable = [
        'COMENTARIO',
        'ID_USUARIO',
        'ID_APORTE'
    ];
}
