<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Libro', function (Blueprint $table) {
            $table->bigIncrements('ID_LIBRO');
            $table->string('CODIGO_BARRA','25');
            $table->integer('COPIA_NUMERO');
            $table->unsignedInteger('ID_MATERIAL')->nullable();
            $table->foreign('ID_MATERIAL')
                ->references('ID_MATERIAL')
                ->on('materialBibliotecario')
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->unsignedInteger('ID_EJEMPLAR')->nullable();
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
        Schema::dropIfExists('Libro');
    }
}
