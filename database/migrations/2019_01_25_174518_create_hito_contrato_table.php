<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHitoContratoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hito_contratos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('fecha_alerta');
            $table->string('fecha_hito');
            $table->integer('contrato_id')->unsigned();
            $table->string('estado_alerta')->nullable();
            $table->timestamps();
            $table->softdeletes();
            
            $table->foreign('contrato_id')->references('id')->on('contratos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hito_contratos');
    }
}
