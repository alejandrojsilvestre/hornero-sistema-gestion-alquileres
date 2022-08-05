<?php

use Faker\Generator as Faker;


$factory->define(App\Contrato::class, function (Faker $faker) {
    $propertyFirstId = \App\Inmueble::orderBy('id', 'DESC')->limit(200)->get()->last()->id;
    $propertyLastId = \App\Inmueble::orderBy('id', 'DESC')->limit(200)->first()->id;
    return [
        'carpeta' => rand(1, 1000),
        'inmueble_id' => rand($propertyFirstId, $propertyLastId),
        'inicio' => date('Y-m-d'),
        'fin' => date('Y-m-d', strtotime(date('Y-m-d') .' +24 months')),
        'caja_id' => 1,
        'cuenta_ingreso_id' => 1,
        'cuenta_egreso_id' => 2,
        'cuenta_honorarios_id' => 3,
    ];
});
