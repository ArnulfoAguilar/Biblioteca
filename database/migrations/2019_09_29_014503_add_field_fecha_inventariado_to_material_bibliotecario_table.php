<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldFechaInventariadoToMaterialBibliotecarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materialBibliotecario', function (Blueprint $table) {
            $table->date('FECHA_INVENTARIADO')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('materialBibliotecario', function (Blueprint $table) {
            //
        });
    }
}
