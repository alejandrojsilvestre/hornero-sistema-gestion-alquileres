<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferencias', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('banco_id')->unsigned();
            $table->string('nro',50);
            $table->date('fecha')->nullable();
            $table->decimal('monto',10,2)->nullable();
            $table->boolean('confirmada')->default(0)->nullable();
            $table->boolean('imputada')->default(0)->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();
        });
        /* Tabla pivote entre evento y inmueble */
        Schema::create('cobro_transferencia', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cobro_id')->unsigned();
            $table->bigInteger('transferencia_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('cobro_id')
                  ->references('id')->on('cobros');
            /* Llaves foraneas */
            $table->foreign('transferencia_id')
                  ->references('id')->on('transferencias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transferencias');
    }
}
