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
            $table->string('SUBTITULO', 400)->nullable();
            $table->string('EDITORIAL', 100)->nullable();
            $table->string('EDICION', 100)->nullable();
            $table->string('AÑO_EDICION', 4)->nullable();
            $table->string('LUGAR_EDICION', 100)->nullable();
            $table->string('OBSERVACIONES', 500)->nullable();
            $table->string('IMAGEN', 300)->nullable();
            $table->string('DESCRIPCION', 1500);
            $table->string('PALABRAS_CLAVE', 500)->nullable();
            $table->integer('NUMERO_PAGINAS')->nullable();
            $table->integer('NUMERO_COPIAS');
            $table->string('AUTOR', 255)->nullable();
            $table->bigInteger('ID_AREA')->nullable()->unsigned();
            $table->foreign('ID_AREA')
                ->references('id')
                ->on('Area')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->bigInteger('ID_TERCER_SUMARIO')->nullable()->unsigned();
            $table->foreign('ID_TERCER_SUMARIO')
                ->references('id')
                ->on('tercerSumario')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->bigInteger('ID_TIPO_EMPASTADO')->nullable()->unsigned();
            $table->foreign('ID_TIPO_EMPASTADO')->references('ID_TIPO_EMPASTADO')
                ->on('tipoEmpastado')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->bigInteger('ID_TIPO_ADQUISICION')->nullable()->unsigned();
            $table->foreign('ID_TIPO_ADQUISICION')->references('ID_TIPO_ADQUISICION')
                ->on('tipoAdquisicion')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            /**$table->bigInteger('ID_ESTADO_EJEMPLAR')->nullable()->unsigned();
            $table->foreign('ID_ESTADO_EJEMPLAR')->references('ID_ESTADO_EJEMPLAR')
                ->on('estadoEjemplar')
                ->onDelete('restrict')
                ->onUpdate('cascade');**/
            $table->bigInteger('ID_IDIOMA')->nullable()->unsigned();
            $table->foreign('ID_IDIOMA')->references('ID_IDIOMA')
                ->on('Idioma')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->bigInteger('ID_CATALOGO_MATERIAL')->nullable()->unsigned();
            $table->foreign('ID_CATALOGO_MATERIAL')
                ->references('id')
                ->on('catalogoMaterial')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->bigInteger('ID_ESTANTE')->nullable()->unsigned();
            $table->foreign('ID_ESTANTE')
                ->references('id')
                ->on('Estante')
                ->onDelete('restrict')
                ->onUpdate('cascade');
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
