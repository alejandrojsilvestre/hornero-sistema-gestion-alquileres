<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfipCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afip_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->string('address');
            $table->string('email');
            $table->foreignId('responsable_type_id')
                    ->constrained('tipos_iva')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->string('responsable_number');
            $table->string('ib');
            $table->string('sales_point', 4);
            $table->date('activity_started_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('afip_credentials');
    }
}
