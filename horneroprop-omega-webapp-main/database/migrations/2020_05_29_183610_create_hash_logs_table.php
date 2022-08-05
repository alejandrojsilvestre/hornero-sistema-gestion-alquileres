<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHashLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hash_logs', function (Blueprint $table) {
            $table->id();
            $table->string('origin_uri')->nullable();
            $table->string('ips');
            $table->string('user_agent');
            $table->unsignedInteger('source_id')->nullable();
            $table->string('source_type', 50)->nullable();
            $table->timestamps();

            $table->index(['source_type', 'source_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hash_logs');
    }
}
