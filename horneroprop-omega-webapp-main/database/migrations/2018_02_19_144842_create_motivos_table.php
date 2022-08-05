<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMotivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('motivos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('color',7);
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();
        });
        DB::insert("INSERT INTO `motivos` (`nombre`, `color`, `sucursal_id`, `empresa_id`, `created_at`, `updated_at`, `deleted_at`) VALUES ('FIRMA DE CONTRATO', '#ffe152', 1, 1, '2018-07-28 22:02:49', '2018-07-28 22:05:11', NULL);");
        DB::insert("INSERT INTO `motivos` (`nombre`, `color`, `sucursal_id`, `empresa_id`, `created_at`, `updated_at`, `deleted_at`) VALUES ('VISITA', '#ff3333', 1, 1, '2018-07-28 22:03:13', '2018-07-28 22:04:55', NULL);");
        DB::insert("INSERT INTO `motivos` (`nombre`, `color`, `sucursal_id`, `empresa_id`, `created_at`, `updated_at`, `deleted_at`) VALUES ('GUARDIA', '#03ff5a', 1, 1, '2018-07-28 22:03:36', '2018-07-28 22:05:06', NULL);");
        DB::insert("INSERT INTO `motivos` (`nombre`, `color`, `sucursal_id`, `empresa_id`, `created_at`, `updated_at`, `deleted_at`) VALUES ('CITA', '#b000fb', 1, 1, '2018-07-28 22:04:19', '2018-07-28 22:05:22', NULL);");
        DB::insert("INSERT INTO `motivos` (`nombre`, `color`, `sucursal_id`, `empresa_id`, `created_at`, `updated_at`, `deleted_at`) VALUES ('LLAMAR', '#3179f4', 1, 1, '2018-07-28 22:04:39', '2018-07-28 22:05:00', NULL);");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motivos');
    }
}
