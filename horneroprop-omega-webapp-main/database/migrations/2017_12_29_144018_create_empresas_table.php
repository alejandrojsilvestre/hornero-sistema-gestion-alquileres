<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social',100);
            $table->integer('tipo_iva_id')->nullable();;
            $table->string('nro_cui',30)->nullable();;
            $table->integer('plan_id')->nullable();; 
            $table->timestamps();
            $table->softDeletes();
        });
        /* Agrego datos por defecto */
        DB::table('empresas')->insert(
        array(
            'razon_social' => 'Hornero'
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
