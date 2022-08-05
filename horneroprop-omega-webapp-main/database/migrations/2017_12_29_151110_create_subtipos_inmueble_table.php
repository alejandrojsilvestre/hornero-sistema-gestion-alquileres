<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubtiposInmuebleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subtipos_inmueble', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',30);
            $table->timestamps();
        });
        DB::insert("INSERT IGNORE INTO `subtipos_inmueble` (`nombre`, `updated_at`, `created_at`) VALUES
            ('Dúplex', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Triplex', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Semipiso', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Piso', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Penthouse', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Loft', '2018-02-23 22:19:22', '2018-02-23 22:19:23'),
            ('Monoambiente', '2018-02-23 22:19:22', '2018-02-23 22:19:23');"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subtipos_inmueble');
    }
}
