<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tercerSumario extends Model
{
    protected $table = 'tercerSumario';
    protected $fillable = [
        'DESCRIPCION',
        'ID_SEGUNDO_SUMARIO',
        'ID_PRIMER_SUMARIO'
    ];
}
