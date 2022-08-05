<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::resourceVerbs([
            'create' => 'crear',
            'show' => 'ver',
            'store' => 'almacenar',
            'update' => 'actualizar',
            'edit' => 'editar',
            'delete' => 'eliminar',
        ]);
        $this->app['request']->server->set('HTTPS', $this->app->environment() != 'local');
        // DB::listen(function ($query) {
        //     var_dump([
        //         $query->sql,
        //         $query->bindings,
        //         $query->time
        //     ]);
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
