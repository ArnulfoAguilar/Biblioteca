<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipoPrestamo extends Model
{
    // Esto estaba en la Rama "Kevin", creo que estaba malo pero por cualquier cosa solo lo comente
    // protected $table = "Prestamo";
    // protected $fillable = [
    //     'FECHA_PRESTAMO',
    //     'ID_USUARIO',
    //     'ID_TIPO_PRESTAMO',
    //     'ID_ESTADO_PRESTAMO',
    //     'ID_MATERIAL'

    // ];
    //
    protected $table = 'tipoPrestamo';

    public function prestamos()
    {
        return $this->hasMany('App\Modelos\Prestamo', 'ID_TIPO_PRESTAMO', 'id');
    }
}
