<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ejemplar extends Model
{
    protected $table = 'Ejemplar';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ISBN',
        'EJEMPLAR',
        'IMAGEN',
        'DESCRIPCION',
        'PALABRAS_CLAVE',
        'NUMERO_PAGINAS',
        'NUMERO_COPIAS',
        'ID_AUTOR',
        'ID_CATEGORIA',
        'ID_TERCER_SUMARIO',
        ];
    use SoftDeletes;

    public function materiales()
    {
        return $this->hasMany('App\materialBibliotecario', 'ID_EJEMPLAR', 'id');
    }
}
