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
            $table->bigIncrements('id');
            $table->string('DESCRIPCION', '255');
            $table->bigInteger('ID_SEGUNDO_SUMARIO')->unsigned();
            // $table->unsignedInteger('ID_SEGUNDO_SUMARIO');
            $table->foreign('ID_SEGUNDO_SUMARIO')
                ->references('id')
                ->on('segundoSumario')
                ->onDelete('restrict')
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
        Schema::dropIfExists('tercerSumario');
    }
}
