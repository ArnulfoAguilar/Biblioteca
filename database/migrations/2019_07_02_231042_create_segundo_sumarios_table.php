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
            $table->bigIncrements('id');
            $table->string('DESCRIPCION','255');
            // $table->unsignedInteger('ID_PRIMER_SUMARIO');
            $table->bigInteger('ID_PRIMER_SUMARIO')->unsigned();
            $table->foreign('ID_PRIMER_SUMARIO')
                ->references('id')
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
