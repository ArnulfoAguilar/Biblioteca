<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aporte extends Model
{
    protected $table='Aporte';
    protected $fillable =[
        'TITULO',
        'DESCRIPCION',
        'CONTENIDO',
        'COMENTARIOS',
        'HABILITADO',
        'ID_AREA',
        'ID_TIPO_APORTE',
        'ID_USUARIO'        
    ];

    public function revisiones()
    {
        return $this->hasMany('App\Revision', 'ID_APORTE', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User', 'ID_USUARIO', 'id');
    }

    public function area()
    {
        return $this->belongsTo('App\Area', 'ID_AREA', 'id');
    }


}
