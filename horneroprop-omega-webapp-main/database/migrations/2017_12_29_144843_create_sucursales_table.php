<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucursalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social',100);
            $table->string('telefono',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('web',100)->nullable();
            $table->string('direccion')->nullable();
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
            $table->string('cod_postal', 10)->nullable();
            $table->bigInteger('tipo_iva_id')->nullable();
            $table->string('nro_cui',30)->nullable();
            $table->string('ingresos_brutos',30)->nullable();
            $table->string('punto_venta',4)->nullable();
            $table->date('inicio_actividades')->nullable();
            $table->string('logo')->nullable();
            $table->string('smtp_server',50)->nullable();
            $table->string('smtp_user',50)->nullable();
            $table->string('smtp_pass',50)->nullable();
            $table->string('smtp_port',5)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('empresa_id')->unsigned();

            /* Llaves foraneas */
            $table->foreign('empresa_id')
                  ->references('id')->on('empresas');
        });
        /* Agrego datos por defecto */
        DB::table('sucursales')->insert(
        array(
            'razon_social' => 'Hornero',
            'empresa_id' => 1,
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sucursales');
    }
}
