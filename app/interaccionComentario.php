<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class interaccionComentario extends Model
{
    protected $table="interaccionComentario";
    protected $fillable=[
        'DESCRIPCION',
        'ID_TIPO_INTERACCION',
        'ID_COMENTARIO',
        'ID_USUARIO'
    ];
}
