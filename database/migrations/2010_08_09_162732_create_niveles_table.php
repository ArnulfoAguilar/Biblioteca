<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNivelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Nivel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NIVEL');
            $table->integer('PUNTAJE_MINIMO');
            $table->string('BAGDE');
            $table->string('BACKGROUND');
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
        Schema::dropIfExists('Nivel');
    }
}
