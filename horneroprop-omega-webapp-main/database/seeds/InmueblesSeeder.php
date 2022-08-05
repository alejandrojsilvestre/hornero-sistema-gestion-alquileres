<?php

use Illuminate\Database\Seeder;

class InmueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Int $companyId = null, Int $subsidiaryId = null)
    {
       	factory(App\Inmueble::class, 200)->create(['empresa_id' => $companyId ?? 1, 'sucursal_id' => $subsidiaryId]);
    }
}
