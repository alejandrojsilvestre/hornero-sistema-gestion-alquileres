  <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->string('apellido',50);
            $table->string('telefono',50)->nullable();
            $table->string('cod_pais', 5)->nullable();
            $table->string('celular',50)->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('tipo_documento_id')->nullable();
            $table->string('nro_documento',50)->nullable();
            $table->bigInteger('tipo_iva_id')->nullable();
            $table->string('nro_cui',50)->nullable();
            $table->string('direccion')->nullable();
            $table->foreignId('pais_id')
                    ->nullable()
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('restrict')
                    ->on('paises');
            $table->foreignId('provincia_id')
                    ->nullable()
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('restrict');
            $table->foreignId('localidad_id')
                    ->nullable()
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('restrict')
                    ->on('localidades');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('cod_postal', 10)->nullable();
            $table->date('fecha_nacimiento')->nullable(); 
            $table->text('notas')->nullable(); 
            $table->timestamps();
            $table->softDeletes();
            $table->string('api_user', 50)->unique()->nullable(); 
            $table->string('api_pass')->nullable(); 
            $table->bigInteger('sucursal_id')->unsigned()->nullable();
            $table->bigInteger('empresa_id')->unsigned()->nullable();

            /* Llaves foraneas */
            $table->foreign('sucursal_id')
                  ->references('id')->on('sucursales');
                  
            $table->foreign('empresa_id')
                  ->references('id')->on('empresas');
        });
        /* Tabla pivote entre personas y tipos de persona */
        Schema::create('persona_tipo', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('persona_id')->unsigned();
            $table->bigInteger('tipo_persona_id')->unsigned();
            $table->timestamps();

            /* Llaves foraneas */
            $table->foreign('persona_id')
                  ->references('id')->on('personas');

            $table->foreign('tipo_persona_id')
                  ->references('id')->on('tipos_persona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
