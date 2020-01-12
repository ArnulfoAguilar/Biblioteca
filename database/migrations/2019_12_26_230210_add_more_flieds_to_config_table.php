<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreFliedsToConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuraciones', function (Blueprint $table) {
            $table->integer('PRESTAMOS_MAXIMOS_ALUMNO')->nullable();
            $table->integer('PRESTAMOS_MAXIMOS_DOCENTE')->nullable();
            $table->integer('PRESTAMOS_MAXIMOS_COMITE')->nullable();
            $table->integer('PRESTAMOS_MAXIMOS_ADMINISTRADOR')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configuraciones', function (Blueprint $table) {
            //
        });
    }
}
