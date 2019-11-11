<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvenioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convenios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proveedor_id')->unsigned();
            $table->string('licitacion');
            $table->string('objeto_contrato');
            $table->string('fecha_inicio');
            $table->string('fecha_termino')->nullable();
            $table->integer('boleta_id')->unsigned(); // Referencia hacia la boleta de Garantía de Fiel Cumplimiento 
            $table->string('alerta_vencimiento')->nullable();
            $table->string('estado_alerta')->nullable();
            $table->timestamps();
            $table->softdeletes();

            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->foreign('boleta_id')->references('id')->on('boletas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convenio');
    }
}
