<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class segundoSumario extends Model
{
    protected $table = 'segundopSumario';
    protected $fillable = [
        'DESCRIPCION',
        'ID_PRIMER_SUMARIO'
    ];
}
