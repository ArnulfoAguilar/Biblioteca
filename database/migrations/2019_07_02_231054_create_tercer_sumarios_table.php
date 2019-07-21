<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTercerSumariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tercerSumario', function (Blueprint $table) {
            $table->bigIncrements('ID_TERCER_SUMARIO');
            $table->string('DESCRIPCION','255');
            $table->bigInteger('ID_SEGUNDO_SUMARIO')->unsigned();
            // $table->unsignedInteger('ID_SEGUNDO_SUMARIO');
            $table->foreign('ID_SEGUNDO_SUMARIO')
                ->references('ID_SEGUNDO_SUMARIO')
                ->on('segundoSumario')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->bigInteger('ID_PRIMER_SUMARIO')->unsigned();
            // $table->unsignedInteger('ID_PRIMER_SUMARIO');
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
        Schema::dropIfExists('tercerSumario');
    }
}
