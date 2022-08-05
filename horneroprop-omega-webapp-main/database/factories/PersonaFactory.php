<?php

use Faker\Generator as Faker;

$factory->define(App\Persona::class, function (Faker $faker) {
    $fake = explode(' ',$faker->name);
    if(isset($fake[2])){
	    $nombre = $fake[1];
		$apellido = $fake[2];
    }else{
	    $nombre = $fake[0];
		$apellido = $fake[1];
    }
    return [
        'nombre' => $nombre,
        'apellido' => $apellido,
        'direccion' => $faker->address,
        'email' => $faker->safeEmail,
        'telefono' => $faker->phoneNumber,
        'celular' => $faker->phoneNumber,
        'nro_documento' => rand(10000000,40000000),
    ];
});
