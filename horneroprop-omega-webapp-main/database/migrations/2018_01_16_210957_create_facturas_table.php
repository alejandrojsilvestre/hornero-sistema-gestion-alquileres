<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cobro_id')
                    ->constrained('cobros')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->foreignId('propietario_id')
                    ->constrained('personas')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->decimal('monto', 10, 2);
            $table->date('fecha');
            $table->string('hash');
            $table->foreignId('empresa_id')
                    ->constrained('empresas')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->foreignId('sucursal_id')
                    ->constrained('sucursales')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
