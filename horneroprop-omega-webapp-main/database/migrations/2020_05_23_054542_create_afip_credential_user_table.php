<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfipCredentialUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afip_credential_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('afip_credential_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('user_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('afip_credential_user');
    }
}
