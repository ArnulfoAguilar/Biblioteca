<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TriggerNuevasCopiasLibros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE TRIGGER TR_AGREGAR_COPIA
            AFTER INSERT ON public."Ejemplar"
            FOR EACH ROW 
            EXECUTE PROCEDURE FUN_AGREGAR_COPIAS();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('
            DROP TRIGGER IF EXISTS TR_AGREGAR_COPIA ON public."Ejemplar";
        ');
    }
}
