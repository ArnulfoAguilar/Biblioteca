<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionAgregarCopia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE OR REPLACE FUNCTION FUN_AGREGAR_COPIAS()
            RETURNS TRIGGER AS $BODY$
            DECLARE
            --CODIGO_BARRA  TEXT := NEW."ISBN" || lpad(NEW."PAGINAS"::char ,6,"0");
            BEGIN
                FOR i IN 1 .. NEW."NUMERO_COPIAS" LOOP
                    INSERT INTO public."materialBibliotecario"("CODIGO_BARRA", "COPIA_NUMERO", "ID_EJEMPLAR","DISPONIBLE","created_at")
                    VALUES(NEW."ISBN" || lpad(i::char ,3,\'0\'), i, NEW.ID, TRUE, localtimestamp);
                END LOOP;
            RETURN NEW;
            END $BODY$
            LANGUAGE PLPGSQL;
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
            DROP FUNCTION IF EXISTS FUN_AGREGAR_COPIAS();
        ');


    }
}


