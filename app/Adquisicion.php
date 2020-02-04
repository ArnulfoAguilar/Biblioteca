<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Adquisicion extends Model
{
    use SoftDeletes;
    protected $table='Adquisicion';
    protected $fillable =[
        'TITULO',
        'DESCRIPCION',
        'CONTENIDO',
        'ID_AREA',
        'ID_USUARIO'        
    ];

    public function interaccionesUsuarios()
    {
        return $this->belongsToMany('App\User', 'interaccion_sugerencia', 'ID_SUGERENCIA', 'ID_USUARIO')->withTimestamps();
    }
}
