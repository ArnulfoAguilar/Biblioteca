<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    protected $table = 'Idioma';
    protected $fillable=['IDIOMA'];
    public function prestamos()
    {
        return $this->hasMany('App\Modelos\Prestamo', 'ID_ESTADO_PRESTAMO', 'id');
    }
    public function ejemplares()
    {
        return $this->hasMany('App\Ejemplar', 'id', 'ID_IDIOMA');
    }
}
