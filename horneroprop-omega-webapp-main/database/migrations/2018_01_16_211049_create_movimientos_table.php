<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('caja_id')->unsigned();
            $table->bigInteger('cuenta_id')->unsigned();
            $table->bigInteger('moneda_id')->unsigned();
            $table->decimal('monto',10,2);
            $table->text('notas')->nullable();
            $table->date('fecha');
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();
            
            $table->foreign('empresa_id')
                  ->references('id')->on('empresas');

            $table->foreign('sucursal_id')
                  ->references('id')->on('sucursales');
        });
        /* Tabla pivote entre movimientos y cobros */
        Schema::create('movimiento_cobro', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('movimiento_id')->unsigned();
            $table->bigInteger('cobro_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('movimiento_id')
                  ->references('id')->on('movimientos');
            /* Llaves foraneas */
            $table->foreign('cobro_id')
                  ->references('id')->on('cobros');
        });
        /* Tabla pivote entre movimientos y contratos */
        Schema::create('movimiento_contrato', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('movimiento_id')->unsigned();
            $table->bigInteger('contrato_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('movimiento_id')
                  ->references('id')->on('movimientos');
            /* Llaves foraneas */
            $table->foreign('contrato_id')
                  ->references('id')->on('contratos');
        });
        /* Tabla pivote entre movimientos y personas */
        Schema::create('movimiento_persona', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('movimiento_id')->unsigned();
            $table->bigInteger('persona_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('movimiento_id')
                  ->references('id')->on('movimientos');
            /* Llaves foraneas */
            $table->foreign('persona_id')
                  ->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
}
