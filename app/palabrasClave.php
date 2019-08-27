<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class palabrasClave extends Model
{
    protected $table='palabrasClave';
    protected $fillable =[
        'PALABRA',
    ];
}
