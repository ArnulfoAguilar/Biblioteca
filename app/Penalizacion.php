<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penalizacion extends Model
{
    protected $table="penalizacion";
    protected $primaryKey = 'id';
    protected $fillable =[
        'ID_PRESTAMO'       
    ];

    public function prestamo()
    {
        return $this->belongsTo('App\Modelos\Prestamo', 'ID_PRESTAMO', 'id');
    }
}
