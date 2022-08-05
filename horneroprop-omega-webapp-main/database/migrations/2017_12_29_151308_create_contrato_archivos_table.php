<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratoArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->string('ruta');
            $table->string('nombre_original',100);
            $table->string('tipo',50);
            $table->string('extension',10);
            $table->integer('tamano');
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

        /* Tabla pivote entre contrato y archivos */
        Schema::create('contrato_archivo', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contrato_id')->unsigned();
            $table->bigInteger('archivo_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            /* Llaves foraneas */
            $table->foreign('contrato_id')
                  ->references('id')->on('contratos');

            $table->foreign('archivo_id')
                  ->references('id')->on('archivos');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivos');
    }
}
