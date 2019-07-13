<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class segundoSumario extends Model
{
    protected $table = 'segundoSumario';
    protected $fillable = [
        'DESCRIPCION',
        'ID_PRIMER_SUMARIO'
    ];
}
