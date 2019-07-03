<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEjemplarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ejemplars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ISBN','13')->unique();
            $table->string('NOMBRE','255');
            $table->string('DESCRIPCION','1500');
            $table->integer('PAGINAS');
            $table->string('AUTOR','255');
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
        Schema::dropIfExists('ejemplars');
    }
}
