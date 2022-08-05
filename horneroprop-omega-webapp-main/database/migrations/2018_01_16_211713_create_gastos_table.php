<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contrato_id')->unsigned();
            $table->bigInteger('concepto_id')->unsigned();
            $table->bigInteger('cobro_id')->unsigned();
            $table->bigInteger('moneda_id')->unsigned()->nullable();
            $table->decimal('monto',10,2)->nullable();
            $table->date('fecha')->nullable();
            $table->string('encargado',1);
            $table->string('pagado_por',1);
            $table->boolean('rota')->default(0)->nullable();
            $table->date('last_check')->comment('Indica cuando fue la ultima vez que se chequeo la rotacion')->nullable();
            $table->smallInteger('cada')->nullable();
            $table->boolean('liquidado')->default(0)->nullable();
            $table->boolean('imputado')->default(0)->nullable();
            $table->boolean('visualizado')->default(0)->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();

            $table->foreign('contrato_id')
                  ->references('id')->on('contratos');
            $table->foreign('concepto_id')
                  ->references('id')->on('conceptos');
            $table->foreign('cobro_id')
                  ->references('id')->on('cobros');
        });

        /* Tabla pivote entre cobros y gastos para traer los liquidado */
        Schema::create('cobro_gasto', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cobro_id')->unsigned();
            $table->bigInteger('gasto_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('cobro_id')
                  ->references('id')->on('cobros');
            /* Llaves foraneas */
            $table->foreign('gasto_id')
                  ->references('id')->on('gastos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gastos');
    }
}
