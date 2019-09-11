<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteraccionComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interaccionComentario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('DESCRIPCION')->nullable();
            $table->unsignedInteger('ID_TIPO_INTERACCION');
            $table->foreign('ID_TIPO_INTERACCION')
            ->references('id')
            ->on('tipoInteraccion')
            ->onDelete('restrict')
            ->onUpdate('cascade');
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
        Schema::dropIfExists('interaccionComentario');
    }
}
