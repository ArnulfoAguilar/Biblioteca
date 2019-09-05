<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAportePalabraClavePivotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aportePalabraClavePivote', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('ID_APORTE');
            $table->foreign('ID_APORTE')
            ->references('id')
            ->on('Aporte')
            ->onDelete('Cascade')
            ->onUpdate('Cascade');
            $table->unsignedInteger('ID_PALABRA_CLAVE');
            $table->foreign('ID_PALABRA_CLAVE')
            ->references('id')
            ->on('palabrasClave')
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
        Schema::dropIfExists('aportePalabraClavePivote');
    }
}
