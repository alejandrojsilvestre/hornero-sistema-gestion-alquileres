<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonedasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monedas', function (Blueprint $table) {
            $table->id();
            $table->string('signo',5);
            $table->string('nombre',30);
            $table->timestamps();
        });
        /* Agrego datos por defecto */
        DB::table('monedas')->insert(
        array(
            'signo' => '$',
            'nombre' => 'Pesos',
        ));
        DB::table('monedas')->insert(
        array(
            'signo' => 'USD',
            'nombre' => 'Dolares',
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monedas');
    }
}
