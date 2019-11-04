<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdquisicionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Adquisicion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('TITULO',250);
            $table->string('DESCRIPCION',250);
            $table->string('CONTENIDO',50000);

            $table->unsignedInteger('ID_AREA');
            $table->foreign('ID_AREA')
            ->references('id')
            ->on('Area')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            
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
        Schema::dropIfExists('Adquisicion');
    }
}
