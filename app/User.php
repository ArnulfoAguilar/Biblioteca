<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Permiso;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ID_ROL', 'BIOGRAFIA' , 'ID_COMITE'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rol()
    {
        return $this->belongsTo('App\Rol', 'ID_ROL', 'id');
    }

    public function comite()
    {
        return $this->belongsTo('App\Comite', 'ID_COMITE', 'id');
    }

    public function aportes()
    {
        return $this->hasMany('App\Aporte', 'ID_USUARIO', 'id');
    }

    public function revisiones()
    {
        return $this->hasMany('App\Revision', 'ID_USUARIO', 'id');
    }

    public function Nivel()
    {
        return $this->belongsTo('App\Niveles', 'ID_NIVEL', 'id');

    }
    public function prestamos()
    {
        return $this->hasMany('App\Modelos\Prestamo', 'ID_USUARIO', 'id');

    }

    public function interaccionesSugerencias()
    {
        return $this->belongsToMany('App\Adquisicion', 'interaccion_sugerencia', 'ID_USUARIO', 'ID_SUGERENCIA')->withTimestamps();
    }

    public function hasPermiso($correlativosSolicitado){
        $correlativos = [];
        foreach ($this->rol->permisos as $permiso) {
            array_push($correlativos, $permiso->correlativo);
        }
        foreach ($correlativosSolicitado as $corSoli) {
            if( ! in_array($corSoli, $correlativos) ){
                return false;
            }
        }
        return true;
    }
}
