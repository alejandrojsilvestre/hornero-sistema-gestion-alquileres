<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposInmuebleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_inmueble', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30);
            $table->timestamps();
        });
        DB::insert("INSERT IGNORE INTO `tipos_inmueble` (`nombre`, `updated_at`, `created_at`) VALUES
            ('Departamento', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Casa', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('PH', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Local', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Oficina', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Cochera', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Nicho-Parcela', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Galpón', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Terreno', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Campo', '2018-02-23 22:19:22', '2018-02-23 22:19:23');"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_inmueble');
    }
}
