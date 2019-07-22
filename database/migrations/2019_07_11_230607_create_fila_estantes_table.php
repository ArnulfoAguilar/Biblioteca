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
            $table->bigIncrements('id');
            $table->string('FILAESTANTE','255');
            $table->bigInteger('ID_ESTANTE')->unsigned();
            // $table->unsignedInteger('ID_ESTANTE');
            $table->foreign('ID_ESTANTE')
                ->references('id')
                ->on('Estante')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->bigInteger('ID_BIBLIOTECA')->unsigned();
            // $table->unsignedInteger('ID_BIBLIOTECA');
            $table->foreign('ID_BIBLIOTECA')
                ->references('id')
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
