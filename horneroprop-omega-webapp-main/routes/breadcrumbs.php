<?php


// Usuarios
Breadcrumbs::register('usuarios', function ($breadcrumbs) {
    $breadcrumbs->push('Usuarios', route('usuarios.index'));
});
// Personas
Breadcrumbs::register('personas', function ($breadcrumbs) {
    $breadcrumbs->push('Personas', route('personas.index'));
});
// Contratos
Breadcrumbs::register('contratos', function ($breadcrumbs) {
    $breadcrumbs->push('Contratos', route('contratos.index'));
});
// Cobros
Breadcrumbs::register('gestiones', function ($breadcrumbs) {
    $breadcrumbs->push('Cobros / Pagos', route('gestiones.index'));
});
// Cobros
Breadcrumbs::register('gastos-impuestos', function ($breadcrumbs) {
    $breadcrumbs->push('Impuestos / Gastos', route('gastos.index'));
});
// Ajuste
Breadcrumbs::register('ajustes', function ($breadcrumbs) {
    $breadcrumbs->push('Ajustes', route('ajustes.index'));
});
// Cheques
Breadcrumbs::register('cheques', function ($breadcrumbs) {
    $breadcrumbs->push('Cheques', route('cheques.index'));
});
// Transferencias
Breadcrumbs::register('transferencias', function ($breadcrumbs) {
    $breadcrumbs->push('Trasferencias', route('transferencias.index'));
});
// Movimientos
Breadcrumbs::register('movimientos', function ($breadcrumbs) {
    $breadcrumbs->push('Resumen de Movimientos', route('movimientos.index'));
});
// Mailing
Breadcrumbs::register('mailing', function ($breadcrumbs) {
    $breadcrumbs->push('Mail enviados', route('mailing.index'));
});
// Plantillas
Breadcrumbs::register('plantillas', function ($breadcrumbs) {
    $breadcrumbs->push('Plantillas', route('plantillas.index'));
});
// Perfiles
Breadcrumbs::register('perfiles', function ($breadcrumbs) {
    $breadcrumbs->push('Perfiles de Usuarios', route('perfiles.index'));
});
// BEGIN: Afip
Breadcrumbs::register('afip-credentials', function ($breadcrumbs) {
    $breadcrumbs->push('Credenciales', route('credenciales.index'));
});
Breadcrumbs::register('afip-invoices', function ($breadcrumbs) {
    $breadcrumbs->push('Facturas', route('facturas.index'));
});
// END: Afip
// Inmuebles
Breadcrumbs::register('inmuebles', function ($breadcrumbs) {
    $breadcrumbs->push('Inmuebles', route('inmuebles.index'));
});
// Eventos
Breadcrumbs::register('eventos', function ($breadcrumbs) {
    $breadcrumbs->push('Eventos', route('eventos.index'));
});