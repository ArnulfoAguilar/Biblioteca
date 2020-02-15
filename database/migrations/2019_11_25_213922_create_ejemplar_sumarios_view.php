<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

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
            CREATE OR REPLACE VIEW public.vwejemplarsumarios
AS SELECT e.id,
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
    e."ID_IDIOMA",
    e."ID_CATALOGO_MATERIAL",
    ts.id AS "ID_TERCER_SUMARIO",
    ss.id AS "ID_SEGUNDO_SUMARIO",
    ps.id AS "ID_PRIMER_SUMARIO",
    e.deleted_at,
    e."PRECIO",
    e."ID_ESTANTE",
    b.id as "ID_BIBLIOTECA",
    e."IMAGEN"
   FROM ( SELECT "Ejemplar".id,
            "Ejemplar"."ISBN",
            "Ejemplar"."EJEMPLAR",
            "Ejemplar"."SUBTITULO",
            "Ejemplar"."EDITORIAL",
            "Ejemplar"."EDICION",
            "Ejemplar"."AÑO_EDICION",
            "Ejemplar"."LUGAR_EDICION",
            "Ejemplar"."OBSERVACIONES",
            "Ejemplar"."IMAGEN",
            "Ejemplar"."DESCRIPCION",
            "Ejemplar"."PALABRAS_CLAVE",
            "Ejemplar"."NUMERO_PAGINAS",
            "Ejemplar"."NUMERO_COPIAS",
            "Ejemplar"."AUTOR",
            "Ejemplar"."ID_AREA",
            "Ejemplar"."ID_TERCER_SUMARIO",
            "Ejemplar"."ID_TIPO_EMPASTADO",
            "Ejemplar"."ID_TIPO_ADQUISICION",
            "Ejemplar"."ID_IDIOMA",
            "Ejemplar"."ID_CATALOGO_MATERIAL",
            "Ejemplar".created_at,
            "Ejemplar".updated_at,
            "Ejemplar".deleted_at,
            "Ejemplar"."PRECIO",
            "Ejemplar"."ID_ESTANTE"
           FROM "Ejemplar"
          WHERE "Ejemplar".deleted_at IS NULL) e
     LEFT JOIN "tercerSumario" ts ON e."ID_TERCER_SUMARIO" = ts.id
     LEFT JOIN "segundoSumario" ss ON ts."ID_SEGUNDO_SUMARIO" = ss.id
     LEFT JOIN "primerSumario" ps ON ss."ID_PRIMER_SUMARIO" = ps.id
    left join "Estante" est on e."ID_ESTANTE" = est.id
    left join "Biblioteca" b on est."ID_BIBLIOTECA" = b.id;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS vwejemplarsumarios');
    }
}
