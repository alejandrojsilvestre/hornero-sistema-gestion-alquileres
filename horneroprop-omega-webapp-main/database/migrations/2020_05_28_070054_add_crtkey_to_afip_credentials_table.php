<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCrtkeyToAfipCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('afip_credentials', function (Blueprint $table) {
            $table->string('crt', 65)->nullable();
            $table->string('key', 65)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('afip_credentials', function (Blueprint $table) {
            $table->dropColumn('crt');
            $table->dropColumn('key');
        });
    }
}
