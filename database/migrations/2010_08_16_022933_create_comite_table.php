<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Comite', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('COMITE',255);
            $table->bigInteger('ID_AREA')->unsigned();
            $table->foreign('ID_AREA')
                ->references('id')
                ->on('Area')
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
        Schema::dropIfExists('Comite');
    }
}
