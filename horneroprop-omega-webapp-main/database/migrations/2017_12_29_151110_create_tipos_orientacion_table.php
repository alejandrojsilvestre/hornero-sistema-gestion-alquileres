<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposOrientacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_orientacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30);
            $table->timestamps();
        });

        DB::insert("INSERT IGNORE INTO `tipos_orientacion` (`nombre`, `updated_at`, `created_at`) VALUES
            ('NORTE', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('SUR', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('ESTE', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('OESTE', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('NORESTE', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('NOROESTE', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('SURESTE', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('SUROESTE', '2018-02-23 22:19:22', '2018-02-23 22:19:23');"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_orientacion');
    }
}
