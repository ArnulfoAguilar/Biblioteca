<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Comentario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('COMENTARIO',255);
            $table->boolean('HABILITADO')->default(false);
            $table->unsignedInteger('ID_USUARIO');
            $table->foreign('ID_USUARIO')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('ID_APORTE');
            $table->foreign('ID_APORTE')
                ->references('id')
                ->on('Aporte')
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
        Schema::dropIfExists('Comentario');
    }
}
