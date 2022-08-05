<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30);
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();
        });
        DB::insert("INSERT IGNORE INTO `servicios` (`nombre`, `updated_at`, `created_at`,`empresa_id`,`sucursal_id`) VALUES
            ('LUZ', '2018-02-23 22:19:22', '2018-02-23 22:19:23', 1 , 1),
            ('GAS', '2018-02-23 22:19:22', '2018-02-23 22:19:23', 1 , 1),
            ('EXPENSAS', '2018-02-23 22:19:22', '2018-02-23 22:19:23', 1 , 1),
            ('ABL', '2018-02-23 22:19:22', '2018-02-23 22:19:23', 1 , 1);"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
