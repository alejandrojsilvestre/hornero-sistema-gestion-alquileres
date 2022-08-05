<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Rutas para Login */
Auth::routes(['register' => false]);
Route::middleware('auth')->group(function () {
	/* Ruta para Logout */
	Route::get('logout',  ['as' => 'logout', 'uses' =>  '\App\Http\Controllers\Auth\LoginController@logout']);
	Route::resource('/', 'DashboardController');
	Route::post('ajustes/uploadLogo', 'AjusteController@uploadLogo')->name('ajustes/uploadLogo');
	Route::resource('ajustes', 'AjusteController');
	/* Begin: Personas */
	Route::prefix('personas')->group(function() {
		Route::get('datatable', 'PersonaController@datatable');
		Route::get('datatableSearch', 'PersonaController@datatableSearch');
		Route::get('search', 'PersonaController@search');
		Route::get('checkUser', 'PersonaController@checkUser');
		Route::get('checkCelular', 'PersonaController@checkCelular');
		Route::get('checkTelefono', 'PersonaController@checkTelefono');
		Route::get('checkMail', 'PersonaController@checkMail');
		Route::get('checkDocumento', 'PersonaController@checkDocumento');
	});
	Route::resource('personas', 'PersonaController');
	/* End: Personas */
	/* Begin: Inmuebles */
	Route::prefix('inmuebles')->group(function() {
		Route::get('/datatable', 'InmuebleController@datatable');
		Route::get('/datatableSearch', 'InmuebleController@datatableSearch');
		Route::get('/search', 'InmuebleController@search');
	});
	Route::resource('inmuebles', 'InmuebleController');
	/* End: Inmuebles */
	/* Modulo: Usuarios */
	Route::get('usuarios/datatable', 'UserController@datatable');
	Route::post('usuarios/uploadPhoto', 'UserController@uploadPhoto')->name('usuarios/uploadPhoto');
	Route::resource('usuarios', 'UserController');
	/* Modulo: Contratos */
	Route::get('contratos/datatable', 'ContratoController@datatable');
	Route::get('contratos/datatableSearch', 'ContratoController@datatableSearch');
	Route::get('contratos/calcularMontos', 'ContratoController@calcularMontos');
	Route::get('contratos/modificarMonto', 'ContratoController@modificarMonto');
	Route::get('contratos/generarCuotas', 'ContratoController@generarCuotas');
	Route::get('contratos/eliminarCuotas', 'ContratoController@eliminarCuotas');
	Route::post('contratos/uploadFiles', 'ContratoController@uploadFiles')->name('contratos/uploadFiles');
	Route::get('contratos/getFiles', 'ContratoController@getFiles')->name('contratos/getFiles');
	Route::resource('contratos', 'ContratoController');
	/* Modulo: Gestiones */
	
	Route::prefix('gestiones')->group(function () {
		// Generales
		Route::get('/getCobros', 'GestionController@getCobros');
		Route::get('/getValores', 'GestionController@getValores');

		// Inquilino
		Route::get('/setValores', 'GestionController@setValores');
		Route::get('/set-liquidated-from-contract', 'GestionController@setLiquidatedFromContract');
		Route::get('/generarRecibo', 'GestionController@generarRecibo');
		Route::get('{cobro}/download-renter-receipt', 'GestionController@downloadRenterReceipt');

		// Propietario
		Route::get('/modificarPorcentaje', 'GestionController@modificarPorcentaje');
		Route::get('/liquidarPropietario', 'GestionController@liquidarPropietario');
		Route::get('/generarLiquidacion', 'GestionController@generarLiquidacion');
		Route::get('/{pago}/download-owner-receipt', 'GestionController@downloadOwnerReceipt');
		// Route::get('/{cobro}/generate-owner-invoice', 'GestionController@generateOwnerInvoice');
		// Route::get('/{invoice}/download-owner-invoice', 'GestionController@downloadOwnerInvoice');
		Route::get('/{cobro}/generate-owner-afip-invoice', 'GestionController@generateOwnerAfipInvoice');
		Route::get('/{afipInvoice}/download-owner-afip-invoice', 'GestionController@downloadOwnerAfipInvoice');

	});
	Route::resource('gestiones', 'GestionController');
	/* Modulo: Gastos */
	Route::get('gastos/getGastosByContrato', 'GastoController@getGastosByContrato');
	Route::resource('gastos', 'GastoController');
	/* Modulo: Impuestos */
	Route::get('impuestos/getImpuestosByContrato', 'ImpuestoController@getImpuestosByContrato');
	Route::resource('impuestos', 'ImpuestoController');
	/* Modulo: Cheques */
	Route::get('cheques/datatable', 'ChequeController@datatable');
	Route::post('cheques/setCobrado', 'ChequeController@setCobrado');
	Route::post('cheques/setImputado', 'ChequeController@setImputado');
	Route::resource('cheques', 'ChequeController');
	/* Modulo: Transferencias */
	Route::get('transferencias/datatable', 'TransferenciaController@datatable');
	Route::post('transferencias/setConfirmada', 'TransferenciaController@setConfirmada');
	Route::post('transferencias/setImputada', 'TransferenciaController@setImputada');
	Route::resource('transferencias', 'TransferenciaController');
	/* Modulo: Transferencias */
	Route::resource('movimientos', 'MovimientoController');
	/* Module: Afip */
	Route::prefix('afip')->group(function () {
		// Begin: Credentials
		Route::prefix('/credenciales')->group(function () {
			Route::get('datatable', 'AfipCredentialController@datatable');
			Route::get('search', 'AfipCredentialController@search');
		});
		Route::resource('/credenciales', 'AfipCredentialController');
		// End: Credentials
		// Begin: Invoinces
		Route::prefix('/facturas')->group(function () {
			Route::get('datatable', 'AfipInvoiceController@datatable');
		});
		Route::resource('/facturas', 'AfipInvoiceController');
		// End: Invoinces
	});
	/* Modulo: Mailing */
	Route::resource('mailing', 'MailingController');
	/* Modulo: Perfiles */
	Route::resource('perfiles', 'PerfilController');
	/* Modulo: Plantillas */
	Route::resource('plantillas', 'PlantillaController');
	/* Modulo: Eventos */
	Route::get('eventos/calendar', 'EventoController@calendar');
	Route::resource('eventos', 'EventoController');
	/* Modulo: Motivos */
	Route::resource('motivos', 'MotivoController');
	/* Modulo: Tipo Documento */
	Route::get('tipo_documento/search', 'TipoDocumentoController@search');
	/* Modulo: Tipo Iva */
	Route::get('tipo_iva/search', 'TipoIvaController@search');
	/* Modulo: Rportes */
	Route::get('reportes/contratos_vigentes', 'ReporteController@contratos_vigentes');
	Route::get('reportes/contratos_inactivos', 'ReporteController@contratos_inactivos');
	Route::get('reportes/inquilinos_cobrar', 'ReporteController@inquilinos_cobrar');
	Route::get('reportes/propietarios_pagar', 'ReporteController@propietarios_pagar');
	Route::get('reportes/caja_diaria', 'ReporteController@caja_diaria');
	Route::get('reportes/movimientos_mes', 'ReporteController@movimientos_mes');
});
Route::get('inquilinos/recibos/{hash}', 'GestionController@getRenterReceiptFromStorage')->name('download-renter-receipt');
Route::get('propietarios/recibos/{hash}', 'GestionController@getOwnerReceiptFromStorage')->name('download-owner-receipt');
Route::get('propietarios/facturas/{hash}', 'GestionController@getOwnerInvoiceFromStorage')->name('download-owner-invoice');
