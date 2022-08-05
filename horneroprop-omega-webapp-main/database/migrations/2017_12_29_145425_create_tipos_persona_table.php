<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposPersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_persona', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30);
            $table->timestamps();
        });
        DB::insert("INSERT IGNORE INTO `tipos_persona` (`nombre`, `updated_at`, `created_at`) VALUES
            ('Propietario', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Inquilino', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Garante', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Cliente', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Agenda', '2018-02-23 22:19:22', '2018-02-23 22:19:23');"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipos_persona', function (Blueprint $table) {
            //
        });
    }
}
