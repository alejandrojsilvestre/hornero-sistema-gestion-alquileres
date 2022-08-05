<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cobro_id')->unsigned();
            $table->bigInteger('propietario_id')->unsigned();
            $table->date('fecha');
            $table->decimal('monto',10,2);
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();

            $table->foreign('cobro_id')
                  ->references('id')->on('cobros');

            $table->foreign('propietario_id')
                  ->references('id')->on('personas');

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
        Schema::dropIfExists('pagos');
    }
}
