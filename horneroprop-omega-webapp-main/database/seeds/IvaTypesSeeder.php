<?php

use Illuminate\Database\Seeder;

class IvaTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('tipos_iva')->insert([
			[
                'nombre' => 'IVA Responsable Inscripto',
                'afip_id' => 1,
                'activo' => 1,
			],
			[
                'nombre' => 'Responsable Monotributo',
                'afip_id' => 6,
                'activo' => 1,
			],
			[
                'nombre' => 'Consumidor Final',
                'afip_id' => 5,
                'activo' => 1,
			],
			[
                'nombre' => 'IVA Sujeto Exento',
                'afip_id' => 4,
                'activo' => 0,
			],
			[
                'nombre' => 'Cliente del Exterior',
                'afip_id' => 9,
                'activo' => 0,
			],
			[
                'nombre' => 'IVA Responsable Inscripto - Agente de Percepción',
                'afip_id' => 11,
                'activo' => 0,
			],
			[
                'nombre' => 'IVA Liberado - Ley Nº 19.640',
                'afip_id' => 10,
                'activo' => 0,
			],
			[
                'nombre' => 'Monotributista Social',
                'afip_id' => 13,
                'activo' => 0,
			],
			[
                'nombre' => 'IVA No Alcanzado',
                'afip_id' => 15,
                'activo' => 0,
			],
        ]);
    }
}