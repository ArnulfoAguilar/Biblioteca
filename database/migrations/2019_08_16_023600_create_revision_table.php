<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Revision', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('DETALLE_REVISION',255);
            $table->bigInteger('ID_ESTADO_REVISION')->unsigned();
            $table->foreign('ID_ESTADO_REVISION')
                ->references('id')
                ->on('estadoRevision')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('ID_COMITE')->unsigned();
            $table->foreign('ID_COMITE')
                ->references('id')
                ->on('Comite')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('ID_APORTE')->unsigned();
            $table->foreign('ID_APORTE')
                ->references('id')
                ->on('Aporte')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('ID_USUARIO')->unsigned();
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
        Schema::dropIfExists('Revision');
    }
}
