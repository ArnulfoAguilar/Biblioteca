<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'Comentario';
    protected $fillable = [
        'COMENTARIO',
        'HABILITADO',
        'ID_USUARIO',
        'ID_APORTE'
    ];
}
