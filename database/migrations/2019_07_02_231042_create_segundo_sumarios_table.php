<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSegundoSumariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('segundoSumario', function (Blueprint $table) {
            $table->bigIncrements('ID_SEGUNDO_SUMARIO');
            $table->string('DESCRIPCION','255');
            $table->unsignedInteger('ID_PRIMER_SUMARIO');
            $table->foreign('ID_PRIMER_SUMARIO')
                ->references('ID_PRIMER_SUMARIO')
                ->on('primerSumario')
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
        Schema::dropIfExists('segundoSumario');
    }
}
