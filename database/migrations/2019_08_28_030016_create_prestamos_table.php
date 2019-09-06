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
            $table->bigIncrements('ID_PRESTAMO');
            $table->date('FECHA_PRESTAMO');
            $table->bigInteger('ID_USUARIO')->unsigned();
            $table->foreign('ID_USUARIO')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('ID_DESPACHO')->unsigned();
            $table->foreign('ID_DESPACHO')->references('ID_DESPACHO')
                ->on('estadoDespacho')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('ID_ESTADO_PRESTAMO')->unsigned();
            $table->foreign('ID_ESTADO_PRESTAMO')->references('ID_ESTADO_PRESTAMO')->on('estadoPrestamo')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('ID_MATERIAL')->unsigned();
            $table->foreign('ID_MATERIAL')->references('id')->on('materialBibliotecario')
                ->onDelete('cascade')
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
        Schema::dropIfExists('prestamos');
    }
}
