<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class palabraProhibida extends Model
{
    protected $table="palabraProhibida";
    protected $fillable = [
        'PALABRA'
    ];
}
