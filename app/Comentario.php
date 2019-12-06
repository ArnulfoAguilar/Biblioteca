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

    public function usuario()
    {
        return $this->belongsTo('App\User', 'ID_USUARIO', 'id');
    }
}
