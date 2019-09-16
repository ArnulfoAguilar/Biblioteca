<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class estadoRevision extends Model
{
    protected $table='estadoRevision';
    protected $fillable =[
        'ESTADO_REVISION',
    ];

    public function revision()
    {
        return $this->hasMany('App\Revision', 'ID_ESTADO_REVISION', 'id');
    }
}
