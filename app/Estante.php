<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estante extends Model
{
    protected $table = 'Estante';
    protected $fillable =[
        'ID_BIBLIOTECA',
        'ESTANTE',
        'CLASIFICACION'
    ];

    public function biblioteca()
    {
        return $this->belongsTo('App\Biblioteca', 'ID_BIBLIOTECA', 'id');
    }
}
