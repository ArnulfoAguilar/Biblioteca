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
            $table->bigIncrements('ID_MATERIAL');
            $table->unsignedInteger('ID_FILA');
            $table->foreign('ID_FILA')
                ->references('ID_FILA')
                ->on('filaEstante');
            $table->unsignedInteger('ID_ESTANTE');
            $table->foreign('ID_ESTANTE')
                ->references('ID_ESTANTE')
                ->on('Estante');
            $table->unsignedInteger('ID_BIBLIOTECA');
            $table->foreign('ID_BIBLIOTECA')
                ->references('ID_BIBLIOTECA')
                ->on('Biblioteca');
            $table->unsignedInteger('ID_CATALOGO_MATERIAL');
            $table->foreign('ID_CATALOGO_MATERIAL')
                ->references('ID_CATALOGO_MATERIAL')
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
