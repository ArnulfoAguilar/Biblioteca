<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialBibliotecariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materialBibliotecario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ID_FILA')->unsigned();
            // $table->unsignedInteger('ID_FILA');
            $table->foreign('ID_FILA')
                ->references('id')
                ->on('filaEstante');
            $table->bigInteger('ID_ESTANTE')->unsigned();
            // $table->unsignedInteger('ID_ESTANTE');
            $table->foreign('ID_ESTANTE')
                ->references('id')
                ->on('Estante');
            $table->bigInteger('ID_BIBLIOTECA')->unsigned();
            // $table->unsignedInteger('ID_BIBLIOTECA');
            $table->foreign('ID_BIBLIOTECA')
                ->references('id')
                ->on('Biblioteca');
            $table->bigInteger('ID_CATALOGO_MATERIAL')->unsigned();
            // $table->unsignedInteger('ID_CATALOGO_MATERIAL');
            $table->foreign('ID_CATALOGO_MATERIAL')
                ->references('id')
                ->on('catalogoMaterial')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
        Schema::dropIfExists('materialBibliotecario');
    }
}
