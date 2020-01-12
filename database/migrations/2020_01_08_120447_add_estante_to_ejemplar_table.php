<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstanteToEjemplarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Ejemplar', function (Blueprint $table) {
            $table->bigInteger('ID_ESTANTE')->unsigned()->nullable();
            $table->foreign('ID_ESTANTE')
                ->references('id')
                ->on('Estante')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Ejemplar', function (Blueprint $table) {
            //
        });
    }
}
