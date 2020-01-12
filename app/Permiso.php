<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permisos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'correlativo',
        'nombre_corto',
        'nombre',
        'descripcion',
        ];

    public function roles()
    {
        return $this->belongsToMany('App\Rol', 'rol_permiso', 'ID_PERMISO', 'ID_ROL')->withTimestamps();
    }
}
