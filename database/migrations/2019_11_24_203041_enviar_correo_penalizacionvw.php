<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnviarCorreoPenalizacionvw extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(' 
        CREATE OR REPLACE VIEW public.enviarcorreopenalizacionvw as
        SELECT p.id,
        p."FECHA_DEVOLUCION",
        u.name,
        u.email
       FROM ("Prestamo" p
         JOIN users u ON ((p."ID_USUARIO" = u.id)))
      WHERE (date(p."FECHA_DEVOLUCION") < CURRENT_DATE) AND p."ID_ESTADO_PRESTAMO"=3
    ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
