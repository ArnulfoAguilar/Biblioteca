<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreFieldsToConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configuraciones', function (Blueprint $table) {
            $table->string('NOMBRE_INSTITUCION');
            $table->string('DIRECCION_INSTITUCION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('configuraciones', function (Blueprint $table) {
            //
        });
    }
}
