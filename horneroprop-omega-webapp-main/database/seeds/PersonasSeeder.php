<?php

use Illuminate\Database\Seeder;

class PersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Int $companyId = null, Int $subsidiaryId = null)
    {
        factory(App\Persona::class, 200)->create(['empresa_id' => $companyId ?? 1, 'sucursal_id' => $subsidiaryId])
           ->each(function(App\Persona $persona){
       		$persona->tipos()->attach([rand(1,5)]);
       	});
    }
}
