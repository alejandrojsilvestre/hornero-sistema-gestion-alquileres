<?php

use Illuminate\Database\Seeder;

class ContratosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Int $companyId, Int $subsidiaryId)
    {
        factory(App\Contrato::class, 3)->create([
                'empresa_id' => $companyId,
                'sucursal_id' => $subsidiaryId,
            ])->each(function(App\Contrato $contrato) use ($companyId, $subsidiaryId){
                $peopleFirstId = \App\Persona::whereEmpresaId($companyId)->whereSucursalId($subsidiaryId)->first()->id;
                $peopleLastId = \App\Persona::whereEmpresaId($companyId)->whereSucursalId($subsidiaryId)->get()->last()->id;
                $contrato->propietarios()->attach([rand($peopleFirstId, $peopleLastId),rand($peopleFirstId, $peopleLastId),rand($peopleFirstId, $peopleLastId)]);
                $contrato->inquilinos()->attach([rand($peopleFirstId, $peopleLastId)]);
                $contrato->garantes()->attach([rand($peopleFirstId, $peopleLastId)]);
       	});
    }
}
