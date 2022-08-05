<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoMontosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrato_montos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contrato_id')->unsigned();
            $table->decimal('monto',10,2);
            $table->date('desde');
            $table->date('hasta');
            $table->softDeletes();
            $table->timestamps();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();
            $table->foreign('contrato_id')
                  ->references('id')->on('contratos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contrato_montos');
    }
}
