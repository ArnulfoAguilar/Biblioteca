<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'ID_ROL', 'BIOGRAFIA'
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

    public function revisiones()
    {
        return $this->hasMany('App\Revision', 'ID_USUARIO', 'id');
    }
    public function Nivel()
    {
        return $this->belongsTo('App\Niveles', 'ID_NIVEL', 'id');
    }
}
