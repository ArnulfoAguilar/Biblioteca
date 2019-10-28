<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE OR REPLACE VIEW public.vwprestamos
            AS SELECT p.id,
                p."FECHA_PRESTAMO",
                ep."ESTADO_PRESTAMO",
                e."EJEMPLAR",
                u."name"
                e."AUTOR",
                e."EDICION",
                e."ID_TIPO_ADQUISICION",
                mb."CODIGO_BARRA"
            FROM "Prestamo" p
                JOIN users u ON p."ID_USUARIO" = u.id
                JOIN "estadoPrestamo" ep ON p."ID_ESTADO_PRESTAMO" = ep.id
                JOIN "materialBibliotecario" mb ON p."ID_MATERIAL" = mb.id
                JOIN "Ejemplar" e ON mb."ID_EJEMPLAR" = e.id;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamos_view');
    }
}
