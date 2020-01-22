<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipoPenalizacion extends Model
{
    
    protected $table = 'tipoPenalizacion';
    protected $primaryKey = 'id';
    protected $fillable =[
        'TIPO_PENALIZACION',
    ];

    public function penalizaciones()
    {
        return $this->hasMany('App\Penalizacion', 'ID_TIPO_PENALIZACION', 'id');
    }
}
