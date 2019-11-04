<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table = "Prestamo";
    protected $fillable = [
        'FECHA_PRESTAMO',
        'FECHA_ESPERADA_DEVOLUCION',
        'ID_USUARIO',
        'ID_TIPO_PRESTAMO',
        'ID_ESTADO_PRESTAMO',
        'ID_MATERIAL'

    ];

    public function usuario()
    {
        return $this->belongsTo('App\User', 'ID_USUARIO', 'id');
    }

    public function penalizacion()
    {
        return $this->belongsTo('App\Penalizacion', 'ID_PRESTAMO', 'id');
    }

    public function material()
    {
        return $this->belongsTo('App\materialBibliotecario', 'ID_MATERIAL', 'id');
    }
}
