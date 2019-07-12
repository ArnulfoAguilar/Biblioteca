<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estante extends Model
{
    protected $table = 'Estante';
    protected $fillable =[
        'ID_BIBLIOTECA',
        'ESTANTE'
    ];
}
