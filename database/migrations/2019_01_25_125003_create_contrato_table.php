<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proveedor_id')->unsigned();
            $table->integer('licitacion_id')->unsigned();
            $table->integer('moneda_id')->unsigned();
            $table->double('precio'); //float porque se hará el cálculo para traspasar a clp si es que es distinto a clp
            $table->double('diferencial')->default('0');
            $table->integer('cargo_id')->unsigned();
            $table->string('nombre_admin_tecnico')->nullable();
            $table->string('fecha_inicio');
            $table->string('fecha_termino')->nullable();
            $table->string('fecha_aprobacion')->nullable();
            $table->string('alerta_vencimiento')->nullable();
            $table->string('objeto_contrato');
            $table->integer('boleta_id')->unsigned();
            $table->string('estado_alerta')->nullable();
            $table->boolean('selectContrato')->default('0');
            $table->timestamps();
            $table->softdeletes();

            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->foreign('boleta_id')->references('id')->on('boletas');
            $table->foreign('moneda_id')->references('id')->on('monedas');
            $table->foreign('licitacion_id')->references('id')->on('licitaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos'); 
    }
}
