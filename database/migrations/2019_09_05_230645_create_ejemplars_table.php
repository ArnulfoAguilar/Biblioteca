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
            $table->bigIncrements('id');
            $table->string('ISBN', 13)->unique();
            $table->string('EJEMPLAR', 500); //Nombre Ejemplar(Título de libro)
            $table->string('SUBTITULO', 400);
            $table->string('EDITORIAL', 100);
            $table->string('EDICION', 100);
            $table->string('AÑO_EDICION', 4);
            $table->string('LUGAR_EDICION', 100);
            $table->string('OBSERVACIONES', 500);
            $table->string('IMAGEN', 100);
            $table->string('DESCRIPCION', 1500);
            $table->string('PALABRAS_CLAVE', 500)->nullable();
            $table->integer('NUMERO_PAGINAS')->nullable();
            $table->integer('NUMERO_COPIAS');
            $table->string('AUTOR', 255)->nullable();
            $table->bigInteger('ID_CATEGORIA')->nullable()->unsigned();
            $table->foreign('ID_CATEGORIA')
                ->references('id')
                ->on('categoriaLibro');
            $table->bigInteger('ID_TERCER_SUMARIO')->nullable()->unsigned();
            $table->foreign('ID_TERCER_SUMARIO')
                ->references('id')
                ->on('tercerSumario');
            $table->bigInteger('ID_TIPO_EMPASTADO');
            $table->foreign('ID_TIPO_EMPASTADO')->references('ID_TIPO_EMPASTADO')->on('tipoEmpastado');
            $table->bigInteger('ID_TIPO_ADQUISICION');
            $table->foreign('ID_TIPO_ADQUISICION')->references('ID_TIPO_ADQUISICION')->on('tipoAdquisicion');
            $table->bigInteger('ID_ESTADO_EJEMPLAR');
            $table->foreign('ID_ESTADO_EJEMPLAR')->references('ID_ESTADO_EJEMPLAR')->on('estadoEjemplar');
            $table->timestamps();
            $table->softDeletes();
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
