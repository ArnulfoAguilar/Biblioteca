<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class materialBibliotecario extends Model
{
    protected $table = 'materialBibliotecario';

    protected $fillable = [
        'ID_MATERIAL',
        'ID_FILA',
        'ID_BIBLIOTECA',
        'ID_ESTANTE',
        'ID_CATALOGO_MATERIAL'
    ];

    public function ejemplar()
    {
        return $this->belongsTo('App\Modelos\Ejemplar', 'ID_EJEMPLAR', 'id');
    }

    public function prestamos()
    {
        return $this->belongsToMany('App\Modelos\Prestamo', 'prestamo_material', 'ID_MATERIAL', 'ID_PRESTAMO')->withTimestamps();
    }
}
