<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //monedas
        View::composer([
            'contratos.form',
            'gastos.modal._form',
            'impuestos.modal._form',
        ], 'App\ViewComposers\MonedaComposer'
        );
        //tipos inmueble
        View::composer([
            'contratos.form',
            'inmuebles.modal._form',
        ], 'App\ViewComposers\TiposInmuebleComposer'
        );
        //subtipos inmueble
        View::composer([
            'contratos.form',
            'inmuebles.modal._form',
        ], 'App\ViewComposers\SubtiposInmuebleComposer'
        );
        //tipo condicion
        View::composer([
            'contratos.form',
            'inmuebles.modal._form',
        ], 'App\ViewComposers\TiposCondicionComposer'
        );
        //tipo orientacion
        View::composer([
            'contratos.form',
            'inmuebles.modal._form',
        ], 'App\ViewComposers\TiposOrientacionComposer'
        );
        //tipos persona
        View::composer([
            'personas.modal._form',
        ], 'App\ViewComposers\TiposPersonaComposer'
        );
        //tipos documento
        View::composer([
            'personas.modal._form',
            'personas.form',
            'users.modal._form',
            'users.form',
        ], 'App\ViewComposers\TiposDocumentoComposer'
        );
        //tipos iva
        View::composer([
            'personas.modal._form',
            'personas.form',
            'users.modal._form',
            'afip.credentials.modal._form',
            'users.form',
            'ajustes.index',
        ], 'App\ViewComposers\TiposIvaComposer'
        );
        // motivos eventos
        View::composer([
            'eventos.modal._form',
        ], 'App\ViewComposers\MotivosEventoComposer'
        );
        // conceptos de gastos
        View::composer([
            'gastos.modal._form',
        ], 'App\ViewComposers\ConceptosComposer'
        );
        // tipos de persona en gastos
        View::composer([
            'impuestos.modal._form',
        ], 'App\ViewComposers\ServiciosComposer'
        );
        // tipos de persona en gastos
        View::composer([
            'gastos.modal._form',
            'contratos.form',
            'gestiones.form',
        ], 'App\ViewComposers\TiposPersonaGastoComposer'
        );
        //bancos
        View::composer([
            'cheques.modal._form',
            'transferencias.modal._form',
        ], 'App\ViewComposers\BancosComposer'
        );
        // cuentas
        View::composer([
            'contratos.form',
        ], 'App\ViewComposers\CuentasComposer'
        );
        // cajas
        View::composer([
            'contratos.form',
            'users.form',
        ], 'App\ViewComposers\CajasComposer'
        );
        // meses
        View::composer([
            'contratos.form',
            'gestiones.form',
        ], 'App\ViewComposers\MesesComposer'
        );
        // notificaciones
        View::composer([
            'layouts.header',
        ], 'App\ViewComposers\NotificacionesComposer'
        );
        // Eventos
        View::composer([
            'layouts.header',
        ], 'App\ViewComposers\EventosComposer'
        );
        // Logs
        View::composer([
            'layouts.header',
        ], 'App\ViewComposers\LogsComposer'
        );
        // Users
        View::composer([
            'afip.credentials.modal._form',
            'eventos.modal._form'
        ], 'App\ViewComposers\UsersComposer');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
