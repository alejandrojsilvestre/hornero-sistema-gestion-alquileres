<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->integer('tipo_id')->unsigned();
            $table->timestamps();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();

            /* Llaves foraneas */
            $table->foreign('sucursal_id')
                  ->references('id')->on('sucursales');
                  
            $table->foreign('empresa_id')
                  ->references('id')->on('empresas');
        });
        DB::insert("INSERT IGNORE INTO `cuentas` (`nombre`, `updated_at`, `created_at`, `sucursal_id`, `empresa_id`) VALUES
            ('Cobros', '2018-02-23 22:19:22', '2018-02-23 22:19:23',1,1),
            ('Pagos', '2018-02-23 22:19:22', '2018-02-23 22:19:23',1,1),
            ('Honorarios', '2018-02-23 22:19:22', '2018-02-23 22:19:23',1,1),
            ('Cheques', '2018-02-23 22:19:22', '2018-02-23 22:19:23',1,1),
            ('Transferencias', '2018-02-23 22:19:22', '2018-02-23 22:19:23',1,1);"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentas');
    }
}
