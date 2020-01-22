<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estadoPrestamo extends Model
{
    //
    protected $table = 'estadoPrestamo';

    public function prestamos()
    {
        return $this->hasMany('App\Modelos\Prestamo', 'ID_ESTADO_PRESTAMO', 'id');
    }
}
