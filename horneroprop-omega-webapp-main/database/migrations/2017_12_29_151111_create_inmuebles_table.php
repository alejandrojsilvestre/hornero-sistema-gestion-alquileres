<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInmueblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->id();
            $table->string('direccion', 100);
            $table->bigInteger('tipo_id')->unsigned()->nullable();
            $table->bigInteger('subtipo_id')->unsigned()->nullable();
            $table->foreignId('pais_id')
                    ->nullable()
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('restrict')
                    ->on('paises');
            $table->foreignId('provincia_id')
                    ->nullable()
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->foreignId('localidad_id')
                    ->nullable()
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('restrict')
                    ->on('localidades');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('cod_postal', 100)->nullable();
            $table->bigInteger('ambientes')->nullable();
            $table->bigInteger('dormitorios')->nullable();
            $table->bigInteger('banos')->nullable();
            $table->bigInteger('toilettes')->nullable();
            $table->bigInteger('cocheras')->nullable();
            $table->text('antiguedad')->nullable();
            $table->bigInteger('emprendimiento_id')->unsigned()->nullable();
            $table->bigInteger('condicion_id')->unsigned()->nullable();
            $table->bigInteger('orientacion_id')->unsigned()->nullable();
            $table->bigInteger('disposicion_id')->unsigned()->nullable();
            $table->decimal('sup_terreno',10,2)->nullable();
            $table->decimal('sup_cubierta',10,2)->nullable();
            $table->decimal('sup_descubierta',10,2)->nullable();
            $table->decimal('sup_semicubierta',10,2)->nullable();
            $table->decimal('sup_total',10,2)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();

            /* Llaves foraneas */
            $table->foreign('tipo_id')
                  ->references('id')->on('tipos_inmueble');
            $table->foreign('subtipo_id')
                  ->references('id')->on('subtipos_inmueble');
            $table->foreign('condicion_id')
                  ->references('id')->on('tipos_condicion');
            $table->foreign('orientacion_id')
                  ->references('id')->on('tipos_orientacion');
            $table->foreign('disposicion_id')
                  ->references('id')->on('tipos_disposicion');
                  
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
        Schema::dropIfExists('inmuebles');
    }
}
