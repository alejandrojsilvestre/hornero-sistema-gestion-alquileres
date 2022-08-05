<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();
            $table->text('texto');
            $table->text('enlace');
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();

            /* Llaves foraneas */
            $table->foreign('sucursal_id')
                  ->references('id')->on('sucursales');
            $table->foreign('empresa_id')
                  ->references('id')->on('empresas');
        });


        /* Tabla pivote entre evento y inmueble */
        Schema::create('notificacion_contrato', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('notificacion_id')->unsigned();
            $table->bigInteger('contrato_id')->unsigned();
            $table->timestamps();

            /* Llaves foraneas */
            $table->foreign('contrato_id')
                  ->references('id')->on('contratos');

            $table->foreign('notificacion_id')
                  ->references('id')->on('notificaciones');
        });

        /* Tabla pivote entre evento y persona */
        Schema::create('notificacion_persona', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('notificacion_id')->unsigned();
            $table->bigInteger('persona_id')->unsigned();
            $table->timestamps();

            /* Llaves foraneas */
            $table->foreign('persona_id')
                  ->references('id')->on('personas');

            $table->foreign('notificacion_id')
                  ->references('id')->on('notificaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificaciones');
    }
}
