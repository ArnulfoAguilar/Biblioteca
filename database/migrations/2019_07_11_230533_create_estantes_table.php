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
            $table->bigIncrements('id');
            $table->bigInteger('ID_BIBLIOTECA')->unsigned();
            // $table->unsignedInteger('ID_BIBLIOTECA');
            $table->foreign('ID_BIBLIOTECA')
                ->references('id')
                ->on('Biblioteca')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->string('ESTANTE', '255');
            $table->string('CLASIFICACION');
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
