<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partidas');
    }
}
