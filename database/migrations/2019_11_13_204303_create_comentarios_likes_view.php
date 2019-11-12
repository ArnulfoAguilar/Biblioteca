<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosLikesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE 
            OR REPLACE VIEW comentariosLikes AS  
            SELECT
                c1.ID,
                c1."COMENTARIO",
                c1."HABILITADO",
                c1."ID_APORTE",
                c1."ID_USUARIO",
                c1.created_at,
                (
                SELECT COUNT
                    ( ic.ID ) AS COUNT 
                FROM
                    "interaccionComentario" ic 
                WHERE
                    ((
                            ic."ID_COMENTARIO" = c1.ID 
                            ) 
                    AND ( ic."ID_TIPO_INTERACCION" = 1 ))) AS total_likes,
                (
                SELECT
                    u.NAME 
                FROM
                    users u 
                WHERE
                ( u.ID = c1."ID_USUARIO" )) AS NAME 
            FROM
                "Comentario" c1
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS comentariosLikes');
    }
}

