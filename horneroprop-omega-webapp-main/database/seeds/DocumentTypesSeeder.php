<?php

use Illuminate\Database\Seeder;

class DocumentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('tipos_documento')->insert([
			[
                'nombre' => 'DNI',
                'afip_id' => 96,
			],
			[
                'nombre' => 'Pasaporte',
                'afip_id' => 94,
			],
			[
                'nombre' => 'LC',
                'afip_id' => 90,
			],
			[
                'nombre' => 'LE',
                'afip_id' => 89,
			],
			[
                'nombre' => 'CI Extranjera',
                'afip_id' => 91,
			],
			[
                'nombre' => 'CDI',
                'afip_id' => 87,
			],
        ]);
    }
}
