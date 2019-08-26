<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'Rol';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ROL',
        ];
    
    public function usuarios()
    {
        return $this->hasMany('App\User', 'ID_ROL', 'id');
    }
}
