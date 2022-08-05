<?php

use Illuminate\Database\Seeder;

class AfipVoucherTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('afip_voucher_types')->insert([
			[
                'name' => 'Factura A',
                'afip_id' => 1,
			],
			[
                'name' => 'Nota de Débito A',
                'afip_id' => 2,
			],
			[
                'name' => 'Nota de Crédito A',
                'afip_id' => 3,
            ],
			[
                'name' => 'Recibos A',
                'afip_id' => 4,
            ],
			[
                'name' => 'Factura B',
                'afip_id' => 6,
            ],
			[
                'name' => 'Nota de Débito B',
                'afip_id' => 7,
            ],
			[
                'name' => 'Nota de Crédito B',
                'afip_id' => 8,
            ],
			[
                'name' => 'Recibos B',
                'afip_id' => 9,
            ],
			[
                'name' => 'Factura C',
                'afip_id' => 11,
            ],
			[
                'name' => 'Nota de Débito C',
                'afip_id' => 12,
            ],
			[
                'name' => 'Nota de Crédito C',
                'afip_id' => 13,
            ],
			[
                'name' => 'Recibo C',
                'afip_id' => 15,
            ],
        ]);
    }
}
