<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calendario extends Model
{
    //
    //protected $table = "calendario";
    use SoftDeletes;
}
