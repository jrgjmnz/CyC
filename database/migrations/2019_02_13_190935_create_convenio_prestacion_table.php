<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvenioPrestacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convenio_prestacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('convenio_id')->unsigned();
            $table->integer('prestacion_id')->unsigned();
            $table->double('valor_seleccionado')->nullable();
            $table->double('factor');
            $table->double('valor_total');
            $table->timestamps();
            $table->softdeletes();

            $table->foreign('convenio_id')->references('id')->on('convenios');
            $table->foreign('prestacion_id')->references('id')->on('prestaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convenio_prestacion');
    }
}
