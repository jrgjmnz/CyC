<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHitoConvenioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hito_convenios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('fecha_alerta');
            $table->string('fecha_hito');
            $table->integer('convenio_id')->unsigned();
            $table->string('estado_alerta')->nullable();
            $table->timestamps();
            $table->softdeletes();

            $table->foreign('convenio_id')->references('id')->on('convenios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hito_convenios');
    }
}
