<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInteraccionSugerenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interaccion_sugerencia', function (Blueprint $table) {
            $table->bigInteger('ID_SUGERENCIA')->unsigned();
            $table->foreign('ID_SUGERENCIA')->references('id')->on('Adquisicion')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->bigInteger('ID_USUARIO')->unsigned();
            $table->foreign('ID_USUARIO')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interaccion_sugerencia');
    }
}
