<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheques', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('banco_id')->unsigned();
            $table->string('nro_cuenta',50);
            $table->string('nro_cheque',50);
            $table->date('fecha');
            $table->decimal('monto',10,2);
            $table->boolean('cobrado')->default(0)->nullable();
            $table->boolean('imputado')->default(0)->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();
        });
        /* Tabla pivote entre evento y inmueble */
        Schema::create('cobro_cheque', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cobro_id')->unsigned();
            $table->bigInteger('cheque_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('cobro_id')
                  ->references('id')->on('cobros');
            /* Llaves foraneas */
            $table->foreign('cheque_id')
                  ->references('id')->on('cheques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cheques');
    }
}
