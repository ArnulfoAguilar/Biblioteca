<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Niveles extends Model
{
    protected $table ='Nivel';
    protected $fillable =[
        'NIVEL',
        'PUNTAJE_MINIMO',
        'BADGE',
        'BACKGROUND'
    ];
    public function Usuarios()
    {
        return $this->hasMany('App\User', 'ID_NIVEL', 'id');
    }
}
