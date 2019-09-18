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
            $table->bigInteger('ID_EJEMPLAR')->nullable()->unsigned();
            $table->foreign('ID_EJEMPLAR')
                ->references('id')
                ->on('Ejemplar')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->boolean('DISPONIBLE')->nullable();
            $table->bigInteger('ID_FILA')->nullable()->unsigned();
            $table->foreign('ID_FILA')
                ->references('id')
                ->on('filaEstante')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->bigInteger('ID_CATALOGO_MATERIAL')->nullable()->unsigned();
            $table->foreign('ID_CATALOGO_MATERIAL')
                ->references('id')
                ->on('catalogoMaterial')
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
        Schema::dropIfExists('materialBibliotecario');
    }
}
