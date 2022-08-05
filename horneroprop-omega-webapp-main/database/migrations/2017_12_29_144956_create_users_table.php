<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 50)->unique()->nullable();
            $table->string('password');
            $table->bigInteger('perfil_id')->nullable();
            $table->bigInteger('tipo_documento_id')->nullable();
            $table->bigInteger('tipo_iva_id')->nullable();
            $table->bigInteger('caja_id')->nullable();
            $table->string('nombre', 50)->nullable();
            $table->string('apellido', 50)->nullable();
            $table->string('telefono', 50)->nullable();
            $table->string('cod_pais', 5)->nullable();
            $table->string('celular', 50)->nullable();
            $table->string('nro_documento',50)->nullable();
            $table->string('nro_cui',50)->nullable();
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
            $table->string('cod_postal',10)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('notas')->nullable();
            $table->string('smtp')->comment('Almacena JSON con datos de SMTP')->nullable();
            $table->text('firma')->comment('Firma para mail')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('admin')->default(0)->comment('Indica si es administrador para habilitar Panel'); 
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('sucursal_id')->unsigned()->nullable();
            $table->bigInteger('empresa_id')->unsigned()->nullable();

            /* Llaves foraneas */
            $table->foreign('sucursal_id')
                  ->references('id')->on('sucursales');

            $table->foreign('empresa_id')
                  ->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

