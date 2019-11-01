<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProrrogasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Prorroga', function (Blueprint $table) {
            $table->bigIncrements('ID_PRORROGA');
            $table->date('FECHA_INICIO');
            $table->date('FECHA_FIN');
            $table->bigInteger('ID_PRESTAMO')->unsigned();
            $table->foreign('ID_PRESTAMO')->references('id')->on('Prestamo')
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
        Schema::dropIfExists('Prorroga');
    }
}
