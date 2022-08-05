<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->insert([
			[
                'email' => 'rodrigo.zaupa@zetahosting.net',
                'password' => bcrypt('sacado99'),
                'nombre' => 'Rodrigo',
                'apellido' => 'Zaupa',
                'admin' => '1',
                'sucursal_id' => '1',
                'empresa_id' => '1',
			],
			[
                'email' => 'franco@mail.com',
                'password' => bcrypt('franco123'),
                'nombre' => 'Franco',
                'apellido' => 'Bianco',
                'admin' => '1',
                'sucursal_id' => '1',
                'empresa_id' => '1',
			],
		]);
    }
}
