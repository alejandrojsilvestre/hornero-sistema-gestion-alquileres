<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inmueble_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->string('carpeta',30)->nullable();
            $table->date('inicio');
            $table->date('fin');
            $table->date('rescision')->nullable();
            $table->bigInteger('moneda_id')->unsigned()->nullable();
            $table->smallInteger('cada')->nullable();
            $table->decimal('porcentaje',4,2)->nullable();
            $table->decimal('monto_garantia',10,2)->nullable();
            $table->smallInteger('moneda_garantia')->unsigned()->nullable();
            $table->decimal('interes',4,2)->nullable();
            $table->decimal('interes_fijo',10,2)->nullable();
            $table->smallInteger('interes_vencimiento')->nullable();
            $table->smallInteger('interes_inicio')->nullable();
            $table->boolean('interes_habil')->nullable();
            $table->decimal('honorarios',10,2)->nullable();
            $table->decimal('honorarios_fijos',10,2)->nullable();
            $table->bigInteger('cuenta_ingreso_id')->unsigned();
            $table->bigInteger('cuenta_egreso_id')->unsigned();
            $table->bigInteger('cuenta_honorarios_id')->unsigned();
            $table->bigInteger('caja_id')->unsigned();
            $table->boolean('imputa_iva_honorarios')->default(0)->nullable();
            $table->boolean('imputa_iva_punitorios')->default(0)->nullable();
            $table->boolean('imputa_iva')->default(0)->nullable();
            $table->boolean('punitorios_habil')->default(0)->nullable();
            $table->boolean('punitorios_administracion')->default(0)->nullable();
            $table->boolean('honorarios_sobre_punitorios')->default(0)->nullable();
            $table->boolean('interes_acumulativo')->default(0)->nullable();
            $table->boolean('honorarios_sobre_cobrado')->default(0)->nullable();
            $table->boolean('activo')->default(1);
            $table->text('notas')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();

            /* Llaves foraneas */
            $table->foreign('cuenta_ingreso_id')
                  ->references('id')->on('cuentas');

            $table->foreign('cuenta_egreso_id')
                  ->references('id')->on('cuentas');

            $table->foreign('cuenta_honorarios_id')
                  ->references('id')->on('cuentas');

            $table->foreign('caja_id')
                  ->references('id')->on('cajas');

            $table->foreign('user_id')
                  ->references('id')->on('users');

            $table->foreign('empresa_id')
                  ->references('id')->on('empresas');

            $table->foreign('sucursal_id')
                  ->references('id')->on('sucursales');
        });

        /* Tabla pivote entre contrato y propietarios */
        Schema::create('contrato_propietario', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contrato_id')->unsigned();
            $table->bigInteger('persona_id')->unsigned();
            $table->decimal('porcentaje',5,2)->nullable();
            $table->timestamps();
            $table->softDeletes();

            /* Llaves foraneas */
            $table->foreign('contrato_id')
                  ->references('id')
                  ->on('contratos')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('persona_id')
                  ->references('id')
                  ->on('personas')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });


        /* Tabla pivote entre contrato e inquilinos */
        Schema::create('contrato_inquilino', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contrato_id')->unsigned();
            $table->bigInteger('persona_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            /* Llaves foraneas */
            $table->foreign('contrato_id')
                  ->references('id')
                  ->on('contratos')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('persona_id')
                  ->references('id')
                  ->on('personas')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });

        /* Tabla pivote entre contrato y garantes */
        Schema::create('contrato_garante', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contrato_id')->unsigned();
            $table->bigInteger('persona_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            /* Llaves foraneas */
            $table->foreign('contrato_id')
                  ->references('id')
                  ->on('contratos')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreign('persona_id')
                  ->references('id')
                  ->onUpdate('cascade')
                  ->onDelete('cascade')
                  ->on('personas');
        });

        /* Tabla pivote entre contrato y partidas */
        Schema::create('contrato_partida', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contrato_id')->unsigned();
            $table->bigInteger('partida_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            /* Llaves foraneas */
            $table->foreign('contrato_id')
                  ->references('id')->on('contratos');

            $table->foreign('partida_id')
                  ->references('id')->on('partidas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contrato_propietario');
        Schema::dropIfExists('contrato_inquilino');
        Schema::dropIfExists('contrato_garante');
        Schema::dropIfExists('contrato_partida');
        Schema::dropIfExists('contratos');
    }
}
