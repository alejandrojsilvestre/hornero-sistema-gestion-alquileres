<?php

use Faker\Generator as Faker;

$factory->define(App\Inmueble::class, function (Faker $faker) {
    return [
        'direccion' => $faker->address,
        'tipo_id' => rand(1,10),
        'subtipo_id' => rand(1,5),
        'ambientes' => rand(1,5),
        'dormitorios' => rand(1,5),
    ];
});
