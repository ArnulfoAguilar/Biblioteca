<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BusquedaMaterialPrestamosView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
        CREATE OR REPLACE VIEW public.BusquedaMaterialPrestamosView
        AS SELECT
        mb."id",
        ej."ID_CATALOGO_MATERIAL",
        ej."EJEMPLAR",
        ej."AUTOR",
        ej."EDICION",
        ej."DESCRIPCION",
        ej."ISBN",
        mb."COPIA_NUMERO",
        ej."ID_TERCER_SUMARIO",
        mb."CODIGO_BARRA",
        fe."ID_BIBLIOTECA",
        fe."ID_ESTANTE",
        fe."FILAESTANTE",
        ej."ID_TIPO_ADQUISICION",
        mb.id AS id_material_bibliotecario,
        ej."IMAGEN",
        mb."OBSERVACIONES"
        FROM "materialBibliotecario" mb
        JOIN "Ejemplar" ej ON mb."ID_EJEMPLAR" = ej.id
        LEFT JOIN "filaEstante" fe ON fe.id = mb."ID_FILA"
        WHERE mb."DISPONIBLE" = true

        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS BusquedaMaterialPrestamosView');
    }
}
