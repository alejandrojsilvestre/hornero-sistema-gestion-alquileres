<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
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

        DB::insert("INSERT IGNORE INTO `cajas` (`nombre`, `updated_at`, `created_at`, `sucursal_id`, `empresa_id`) VALUES
            ('Caja General', '2018-02-23 22:19:22', '2018-02-23 22:19:23',1,1)"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cajas');
    }
}
