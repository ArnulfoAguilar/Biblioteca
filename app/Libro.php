<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'Libro';
    protected $primaryKey = 'ID_LIBRO';
    protected $fillable = [
        'ID_LIBRO',
        'CODIGO_BARRA',
        'COPIA_NUMERO',
        'ID_EJEMPLAR',
        'ID_MATERIAL'
    ];

    public function ejemplar()
    {
        return $this->belongsTo('App\Ejemplar', 'ID_EJEMPLAR');
    }
    
}
