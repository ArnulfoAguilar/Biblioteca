<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilaEstantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filaEstante', function (Blueprint $table) {
            $table->bigIncrements('ID_FILA');
            $table->string('FILAESTANTE','255');
            $table->unsignedInteger('ID_ESTANTE');
            $table->foreign('ID_ESTANTE')
                ->references('ID_ESTANTE')
                ->on('Estante')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->unsignedInteger('ID_BIBLIOTECA');
            $table->foreign('ID_BIBLIOTECA')
                ->references('ID_BIBLIOTECA')
                ->on('Biblioteca')
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
        Schema::dropIfExists('filaEstante');
    }
}
