<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

class CompaniesCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'companies:create 
    {--name= : Nombre de la empresa.}
    {--subsidiaryName= : Nombre de la sucursal.}
    {--user= : Nombre de usuario.}
    {--password= : Password de usuario.}
    {--testData= : Datos de prueba.}
    ';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea una empresa para que pueda comenzar a utilizar el sistema';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (App::environment('production') || App::environment('prod')) {
            if (!$this->confirm('El entorno es PRODUCCIÓN. ¿Está seguro que desea cargar los datos?')) {
                $this->line('¡El comando no fue ejecutado!');
                return;
            }
        };
        $companyName = $this->option('name')?? $this->ask('Ingresar nombre de la empresa');
        if (!$companyName) {
            $this->error('¡Debe ingresar nombre de empresa!');
            return;
        }

        $subsidiaryName = $this->option('subsidiaryName')?? $this->ask('Ingresar nombre de la sucursal');
        if (!$subsidiaryName) {
            $this->error('¡Debe ingresar nombre de sucursal!');
            return;
        }

        $userEmail = $this->option('user')?? $this->ask('Ingresar nombre de usuario (email)');
        if (!$userEmail) {
            $this->error('¡Debe ingresar nombre de usuario!');
            return;
        }

        $userPassword = $this->option('password')?? $this->secret('Ingresar password de usuario');
        if (!$userPassword) {
            $this->error('¡Debe ingresar password de usuario!');
            return;
        }

        $testData = $this->option('testData')?? $this->confirm('¿Desea cargar datos de prueba?');

		DB::beginTransaction();
        $company = \App\Empresa::create(['razon_social' => $companyName]);
        $subsidiary = \App\Sucursal::create(['razon_social' => $subsidiaryName, 'empresa_id' => $company->id]);
        $user = \App\User::create(['email' => $userEmail, 'password' => $userPassword, 'empresa_id' => $company->id, 'sucursal_id' => $subsidiary->id]);

        if ($testData) {
            $peopleSeeder = new \PersonasSeeder;
            $propertySeeder = new \InmueblesSeeder;
            $contractSeeder = new \ContratosSeeder;
            
            $peopleSeeder->run($company->id, $subsidiary->id);
            $propertySeeder->run($company->id, $subsidiary->id);
            $contractSeeder->run($company->id, $subsidiary->id);
        }
        DB::commit();
        $this->line('¡La empresa fue generada con éxito!');
    }
}
