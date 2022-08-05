<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImpuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impuestos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contrato_id')->unsigned();
            $table->bigInteger('servicio_id')->unsigned();
            $table->bigInteger('cobro_id')->unsigned();
            $table->bigInteger('moneda_id')->unsigned()->nullable();
            $table->decimal('monto',10,2)->nullable();
            $table->boolean('rota')->default(0)->nullable();
            $table->smallInteger('cada')->unsigned()->nullable();
            $table->boolean('entregado')->default(0)->nullable();
            $table->boolean('visualizado')->default(0)->nullable();
            $table->date('last_check')->comment('Indica cuando fue la ultima vez que se chequeo la rotacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();

            $table->foreign('contrato_id')
                  ->references('id')->on('contratos');
            $table->foreign('servicio_id')
                  ->references('id')->on('servicios');
            $table->foreign('cobro_id')
                  ->references('id')->on('cobros');
        });
         /* Tabla pivote entre cobros y gastos para traer los liquidado */
        Schema::create('cobro_impuesto', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cobro_id')->unsigned();
            $table->bigInteger('impuesto_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('cobro_id')
                  ->references('id')->on('cobros');
            /* Llaves foraneas */
            $table->foreign('impuesto_id')
                  ->references('id')->on('impuestos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('impuestos');
    }
}
