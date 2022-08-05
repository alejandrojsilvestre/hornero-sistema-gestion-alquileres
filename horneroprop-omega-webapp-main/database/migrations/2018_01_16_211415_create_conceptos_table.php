<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConceptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conceptos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30);
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('sucursal_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned();
        });
        DB::insert("INSERT IGNORE INTO `conceptos` (`nombre`, `updated_at`, `created_at`,`empresa_id`,`sucursal_id`) VALUES
            ('EXPENSAS EXT.', '2018-02-23 22:19:22', '2018-02-23 22:19:23', 1, 1),
            ('REPARACION', '2018-02-23 22:19:22', '2018-02-23 22:19:23', 1, 1),
            ('FIRMA', '2018-02-23 22:19:22', '2018-02-23 22:19:23', 1, 1),
            ('DEP. GARANTIA', '2018-02-23 22:19:22', '2018-02-23 22:19:23', 1, 1);"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conceptos');
    }
}
