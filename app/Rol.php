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

    public function permisos()
    {
        return $this->belongsToMany('App\Permiso', 'rol_permiso', 'ID_ROL', 'ID_PERMISO')->withTimestamps();
    }
}
