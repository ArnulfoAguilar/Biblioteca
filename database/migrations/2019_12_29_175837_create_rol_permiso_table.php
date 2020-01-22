<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolPermisoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_permiso', function (Blueprint $table) {

            $table->bigInteger('ID_ROL')->unsigned();
            $table->foreign('ID_ROL')->references('id')->on('Rol')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->bigInteger('ID_PERMISO')->unsigned();
            $table->foreign('ID_PERMISO')->references('id')->on('permisos')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol_permiso');
    }
}
