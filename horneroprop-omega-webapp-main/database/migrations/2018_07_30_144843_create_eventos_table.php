<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('direccion', 200)->nullable();
            $table->string('titulo', 200)->nullable();
            $table->text('notas')->nullable();
            $table->datetime('inicio');
            $table->datetime('fin');
            $table->bigInteger('motivo_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('created_by_id')->unsigned();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();

            /* Llaves foraneas */
            $table->foreign('motivo_id')
                  ->references('id')->on('motivos');

            $table->foreign('created_by_id')
                  ->references('id')->on('users');

            $table->foreign('sucursal_id')
                  ->references('id')->on('sucursales');

            $table->foreign('empresa_id')
                  ->references('id')->on('empresas');

        });

        /* Tabla pivote entre evento y inmueble */
        Schema::create('evento_inmueble', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('evento_id')->unsigned();
            $table->bigInteger('inmueble_id')->unsigned();
            $table->timestamps();

            /* Llaves foraneas */
            $table->foreign('evento_id')
                  ->references('id')->on('eventos');

            $table->foreign('inmueble_id')
                  ->references('id')->on('inmuebles');
        });

        /* Tabla pivote entre evento y persona */
        Schema::create('evento_persona', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('evento_id')->unsigned();
            $table->bigInteger('persona_id')->unsigned();
            $table->timestamps();

            /* Llaves foraneas */
            $table->foreign('evento_id')
                  ->references('id')->on('eventos');

            $table->foreign('persona_id')
                  ->references('id')->on('personas');
        });

        /* Tabla pivote entre evento y persona */
        Schema::create('evento_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('evento_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            /* Llaves foraneas */
            $table->foreign('evento_id')
                  ->references('id')->on('eventos');

            $table->foreign('user_id')
                  ->references('id')->on('users');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
