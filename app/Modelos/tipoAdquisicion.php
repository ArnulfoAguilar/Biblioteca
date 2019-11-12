<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class tipoAdquisicion extends Model
{
    //
    protected $table="tipoAdquisicion";
    protected $primaryKey = 'ID_TIPO_ADQUISICION';


    public function ejemplar()
    {
        return $this->hasMany('App\Modelos\Ejemplar', 'ID_TIPO_ADQUISICION', 'ID_TIPO_ADQUISICION');
    }
}
