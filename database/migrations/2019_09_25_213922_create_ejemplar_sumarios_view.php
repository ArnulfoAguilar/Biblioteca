<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateEjemplarSumariosView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE OR REPLACE VIEW public.vwEjemplarSumarios
            AS select
            e.id,
            e."ISBN",
            e."EJEMPLAR",
            e."SUBTITULO",
            e."EDITORIAL",
            e."EDICION",
            e."AÑO_EDICION",
            e."LUGAR_EDICION",
            e."OBSERVACIONES",
            e."DESCRIPCION",
            e."NUMERO_PAGINAS",
            e."NUMERO_COPIAS",
            e."AUTOR",
            e."ID_AREA",
            e."ID_TIPO_EMPASTADO",
            e."ID_TIPO_ADQUISICION",
            e."ID_ESTADO_EJEMPLAR",
            e."ID_CATALOGO_MATERIAL",
            ts.id as "ID_TERCER_SUMARIO",
            ss.id as "ID_SEGUNDO_SUMARIO",
            ps.id as "ID_PRIMER_SUMARIO"
            from "Ejemplar" e
            join "tercerSumario" ts on e."ID_TERCER_SUMARIO" = ts.id
            join "segundoSumario" ss on ts."ID_SEGUNDO_SUMARIO" = ss.id
            join "primerSumario" ps on ss."ID_PRIMER_SUMARIO"=ps.id;

        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS vwEjemplarSumarios');
    }
}
