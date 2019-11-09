<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenalizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penalizacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('SOLVENTADA');

            $table->unsignedInteger('ID_PRESTAMO');
            $table->foreign('ID_PRESTAMO')
            ->references('id')
            ->on('Prestamo')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unsignedInteger('ID_TIPO_PENALIZACION');
            $table->foreign('ID_TIPO_PENALIZACION')
            ->references('id')
            ->on('tipoPenalizacion')
            ->onUpdate('cascade')
            ->onDelete('cascade');

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
        Schema::dropIfExists('penalizacion');
    }
}
