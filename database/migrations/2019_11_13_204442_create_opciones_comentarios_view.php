<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpcionesComentariosView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE OR REPLACE VIEW opcionescomentario AS
            SELECT C
            .ID AS "ID_COMENTARIO",
            C."COMENTARIO",
            C."HABILITADO",
            (
            SELECT
                users_1.NAME AS autor_co 
            FROM
                users users_1 
            WHERE
            ( C."ID_USUARIO" = users_1.ID )) AS "AUTOR_COMENTARIO",
            C."ID_APORTE",
            C.created_at AS "DATE_CREA_COMENT",
            C.updated_at AS "DATE_UPD_COMENT",
            ic."ID_TIPO_INTERACCION",
            ic."ID_COMENTARIO" AS "ID_COMENT_FK",
            ic."ID_USUARIO" AS "ID_USUARIO_INTERACCION",
            ic.created_at AS "DATE_CREATE_INTERACCION",
            ic.updated_at AS "DATE_UPD_INTERACCION",
            (
            SELECT
                users_1.NAME AS autor_co 
            FROM
                users users_1 
            WHERE
            ( ic."ID_USUARIO" = users_1.ID )) AS autor_interaccion 
        FROM
            ((
                    "Comentario"
                    C LEFT JOIN "interaccionComentario" ic ON ((
                            C.ID = ic."ID_COMENTARIO" 
                        )))
                JOIN users ON ((
                    C."ID_USUARIO" = users.ID 
            )))
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS opcionescomentario');
    }
}
