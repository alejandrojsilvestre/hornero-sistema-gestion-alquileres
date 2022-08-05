<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(PersonasSeeder::class);
        // $this->call(InmueblesSeeder::class);
        // $this->call(ContratosSeeder::class);
        $this->call([
            UsersSeeder::class,
            DocumentTypesSeeder::class,
            IvaTypesSeeder::class,
            AfipVoucherTypesSeeder::class,
        ]);
    }
}
