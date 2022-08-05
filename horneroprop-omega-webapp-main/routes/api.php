<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('/auth')->group(function () {
    Route::post('/login', 'Api\AuthController@login');
});
Route::middleware('auth:api')->group(function () {
    Route::prefix('/auth')->group(function() {
        Route::get('/me', 'Api\AuthController@me');
        Route::post('/logout', 'Api\AuthController@logout');
    });
    Route::prefix('/inquilino')->group(function() {
        Route::get('{inquilino}/getData', 'Api\InquilinoController@getData');
        Route::post('/setFileToContrato', 'ApiController@setFileToContrato');
    });
    Route::post('/propietario/getDatos', 'ApiController@getDatosPropietario');
});

/*
PARA INQUILINOS
GETCOBROS
GETPAGOS
GETGASTOS
GETIMPUESTOS
GETRECLAMOS
NEWRECLAMO
UPDATERECLAMO

PARA PROPIETARIOS
GETCONTRATOS
GETCOBROSPENDIENTES
GETCOBROSREALIZADOS
GETGASTOS
GETFACTURAS
NEWRECLAMO
UPDATERECLAMO

*/