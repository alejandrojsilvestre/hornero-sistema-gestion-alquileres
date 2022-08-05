<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCobrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobros', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contrato_id')->unsigned();
            $table->bigInteger('inquilino_id')->unsigned()->nullable();
            $table->smallInteger('mes')->nullable();
            $table->smallInteger('ano')->nullable();
            $table->date('fecha')->nullable();
            $table->decimal('monto', 10, 2)->nullable();
            $table->decimal('punitorio',10,2)->nullable();
            $table->decimal('monto_total',10,2)->nullable();
            $table->decimal('monto_pagado',10,2)->nullable();
            $table->decimal('monto_deuda',10,2)->nullable();
            $table->decimal('monto_tope',10,2)->nullable();
            $table->decimal('monto_pagar',10,2)->nullable();
            $table->decimal('honorarios',10,2)->nullable();
            $table->boolean('liquidado')->default(0)->nullable();
            $table->boolean('propietarios_liquidados')->default(0)->nullable();
            $table->boolean('is_deuda')->default(0)->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();

            $table->foreign('contrato_id')
                  ->references('id')->on('contratos');

            $table->foreign('inquilino_id')
                  ->references('id')->on('personas');

            $table->foreign('empresa_id')
                  ->references('id')->on('empresas');

            $table->foreign('sucursal_id')
                  ->references('id')->on('sucursales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cobros');
    }
}
