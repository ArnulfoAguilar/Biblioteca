<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Prestamo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('FECHA_PRESTAMO');
            $table->dateTime('FECHA_DEVOLUCION')->nullable();
            $table->bigInteger('ID_USUARIO')->unsigned();
            $table->foreign('ID_USUARIO')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->bigInteger('ID_TIPO_PRESTAMO')->nullable()->unsigned();
            $table->foreign('ID_TIPO_PRESTAMO')->references('id')
                ->on('tipoPrestamo')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->bigInteger('ID_ESTADO_PRESTAMO')->unsigned();
            $table->foreign('ID_ESTADO_PRESTAMO')->references('id')->on('estadoPrestamo')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->bigInteger('ID_MATERIAL')->unsigned();
            $table->foreign('ID_MATERIAL')->references('id')->on('materialBibliotecario')
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
        Schema::dropIfExists('Prestamo');
    }
}
