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
            $table->string('CODIGO_BARRA', '25');
            $table->integer('COPIA_NUMERO');
            $table->bigInteger('ID_FILA')->unsigned();
            $table->foreign('ID_FILA')
                ->references('id')
                ->on('filaEstante');
            $table->bigInteger('ID_CATALOGO_MATERIAL')->unsigned();
            $table->foreign('ID_CATALOGO_MATERIAL')
                ->references('id')
                ->on('catalogoMaterial')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->bigInteger('ID_EJEMPLAR')->nullable()->unsigned();
            $table->foreign('ID_EJEMPLAR')
                ->references('id')
                ->on('Ejemplar')
                ->onUpdate('restrict')
                ->onDelete('restrict');
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
