<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Estante', function (Blueprint $table) {
            $table->bigIncrements('ID_ESTANTE');
            $table->unsignedInteger('ID_BIBLIOTECA');
            $table->foreign('ID_BIBLIOTECA')
                ->references('ID_BIBLIOTECA')
                ->on('Biblioteca')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->string('ESTANTE','255');
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
        Schema::dropIfExists('Estante');
    }
}
