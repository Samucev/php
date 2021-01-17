<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\ColectionController;
use App\Http\Controllers\VentaController;

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

Route::prefix('usuarios')->group(function () {
	Route::post('/registrar',[UsuarioController::class,"registrar"]);
	Route::post('/login',[UsuarioController::class,"login"]);
	Route::post('/recuperar',[UsuarioController::class,"recuperarPassword"]);
});


Route::prefix('cards')->group(function () {
	Route::post('/create',[CardsController::class,"createcard"])->middleware('guest')
;

});
Route::prefix('venta')->group(function () {
	Route::post('/createventa',[VentaController::class,"createventa"]);
	Route::get('/listaventas/{name_venta}',[VentaController::class,"listaventas"]);
	Route::get('/listarcompras/{name_venta}',[VentaController::class,"listarcompras"]);
});

Route::prefix('colection')->group(function () {
	Route::post('/create',[ColectionController::class,"createcolection"])->middleware('guest')
;

});


