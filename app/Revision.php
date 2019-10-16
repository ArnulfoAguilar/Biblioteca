<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $table='Revision';
    protected $fillable =[
        'DETALLE_REVISION',
        'ID_ESTADO_REVISION',
        'ID_COMITE',
        'ID_APORTE',
        'ID_USUARIO'        
    ];

    public function aporte()
    {
        return $this->belongsTo('App\Aporte', 'ID_APORTE', 'id');
    }

    public function estadoRevision()
    {
        return $this->belongsTo('App\estadoRevision', 'ID_ESTADO_REVISION', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User', 'ID_USUARIO', 'id');
    }
}
