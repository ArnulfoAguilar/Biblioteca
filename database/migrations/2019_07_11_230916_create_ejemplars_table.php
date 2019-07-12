<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEjemplarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Ejemplar', function (Blueprint $table) {
            $table->increments('ID_EJEMPLAR');
            $table->string('ISBN','13')->unique();
            $table->string('EJEMPLAR','500');
            $table->string('IMAGEN','100');
            $table->string('DESCRIPCION','1500');
            $table->string('PALABRAS_CLAVE',500);
            $table->integer('NUMERO_PAGINAS');
            $table->integer('NUMERO_COPIAS');
            $table->string('AUTOR','255');
            $table->unsignedInteger('ID_CATEGORIA');
            $table->foreign('ID_CATEGORIA')
                ->references('ID_CATEGORIA')
                ->on('categoriaLibro');
            $table->unsignedInteger('ID_TERCER_SUMARIO');
            $table->foreign('ID_TERCER_SUMARIO')
                ->references('ID_TERCER_SUMARIO')
                ->on('tercerSumario');
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
        Schema::dropIfExists('Ejemplar');
    }
}
