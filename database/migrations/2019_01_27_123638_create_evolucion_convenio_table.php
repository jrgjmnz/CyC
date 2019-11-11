<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvolucionConvenioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evolucion_convenios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fecha');
            $table->integer('convenio_id')->unsigned();
            $table->string('texto');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('convenio_id')->references('id')->on('convenios');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evolucion_convenios');
    }
}
