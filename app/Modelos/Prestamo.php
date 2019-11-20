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
        'ID_MATERIAL',
        'ID_PENALIZACION',

    ];

    public function usuario()
    {
        return $this->belongsTo('App\User', 'ID_USUARIO', 'id');
    }

    public function penalizaciones()
    {
        return $this->hasMany('App\Penalizacion', 'ID_PRESTAMO', 'id');
    }

    public function materiales()
    {
        return $this->belongsToMany('App\materialBibliotecario', 'prestamo_material', 'ID_PRESTAMO', 'ID_MATERIAL')->withTimestamps();
    }

    public function tipoPrestamo()
    {
        return $this->belongsTo('App\tipoPrestamo', 'ID_TIPO_PRESTAMO', 'id');
    }

    public function estadoPrestamo()
    {
        return $this->belongsTo('App\estadoPrestamo', 'ID_ESTADO_PRESTAMO', 'id');
    }
}
