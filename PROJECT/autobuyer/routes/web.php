<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VistasController;
use App\Http\Controllers\AutosController;
use App\Http\Controllers\AutenticacionSesionController;


//===RUTAS GET DE CARGA DE VISTAS====//
//Las rutas GET cargan plantillas Blade (las vistas).
//Algunas rutas estan protegidas 'auth' para usuarios logeados
Route::get('/', [VistasController::class, 'index'])
	->name('inicio');

Route::get('/autos', [VistasController::class, 'consultaAutos'])
	->name('consulta.autos');

Route::get('/auto/{id}', [VistasController::class, 'consultaAuto'])
	->name('consulta.auto');

Route::get('/auto-alta', [VistasController::class, 'altaAuto'])
	->name('alta.auto')
	->middleware('auth');

Route::get('/auto-mto/{auto}', [VistasController::class, 'mantenimientoAuto'])
	->name('mantenimiento.auto')
	->middleware('auth');



//===RUTAS CRUD (operaciones POST PUT DELETE con BD)====//
//Las rutas POST/PUT/DELETE procesan los datos del formulario (alta, modificación, baja).

Route::post('/auto-alta', [AutosController::class, 'alta'])
	->name('crud.auto.alta')
	->middleware('auth');

Route::put('/auto-mto/{auto}', [AutosController::class, 'modificacion'])
	->name('crud.auto.modificacion')
	->middleware('auth');

Route::delete('/auto-mto/{auto}', [AutosController::class, 'baja'])
	->name('crud.auto.baja')
	->middleware('auth');



//=====RUTAS DE AUTENTICACION=======//
//carga vista login
Route::get('/login', [AutenticacionSesionController::class, 'vistalogin'])
	->name('vista.login');
//	->middleware('guest'); // evita que un user authenticado pueda volver al form de login //OJO DUPLICADO

//solicitud del login al pulsar el boton del formulario
Route::post('/login', [AutenticacionSesionController::class, 'login'])
	->name('login');
//	->middleware('guest'); //OJO DUPLICADO

//ruta desconexion
Route::post('/logout', [AutenticacionSesionController::class, 'logout'])
	->name('logout');
//	->middleware('auth'); // protege el cierre de session