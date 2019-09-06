<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBitacoraComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacoraComentario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('LIKE')->nullable();
            $table->boolean('REPORT')->nullable();
            $table->string('DESCRIPCION')->nullable();
            $table->unsignedInteger('ID_COMENTARIO');
            $table->foreign('ID_COMENTARIO')
            ->references('id')
            ->on('Comentario')
            ->onDelete('Cascade')
            ->onUpdate('Cascade');
            $table->unsignedInteger('ID_USUARIO');
            $table->foreign('ID_USUARIO')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
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
        Schema::dropIfExists('bitacoraComentario');
    }
}
