<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposCondicionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_condicion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30);
            $table->timestamps();
        });

        DB::insert("INSERT IGNORE INTO `tipos_condicion` (`nombre`, `updated_at`, `created_at`) VALUES
            ('A ESTRENAR', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('EXCELENTE', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('MUY BUENA', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('BUENA', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('REFACCIONAR', '2018-02-23 22:19:22', '2018-02-23 22:19:23');"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_condicion');
    }
}
