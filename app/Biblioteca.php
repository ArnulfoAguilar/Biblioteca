<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biblioteca extends Model
{
    protected $table = 'Biblioteca';
    protected $fillable = [
        'BIBLIOTECA'
    ];

    public function estantes()
    {
        return $this->hasMany('App\Estante', 'ID_BIBLIOTECA', 'id');
    }
}
