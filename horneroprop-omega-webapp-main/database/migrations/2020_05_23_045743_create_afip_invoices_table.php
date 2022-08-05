<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfipInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afip_invoices', function (Blueprint $table) 
        {
            $table->id();
            $table->string('cae');
            $table->date('cae_expiration');
            $table->string('invoice_number');
            $table->decimal('amount', 10, 2);
            $table->decimal('iva_amount', 10, 2)->nullable();
            $table->date('date');
            $table->string('hash');
            $table->foreignId('afip_credential_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->foreignId('cobro_id')
                    ->constrained('cobros')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->foreignId('persona_id')
                    ->constrained('personas')
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->foreignId('empresa_id')
                    ->constrained('empresas')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('sucursal_id')
                    ->constrained('sucursales')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('afip_invoices');
    }
}
