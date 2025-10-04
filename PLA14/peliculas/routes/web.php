<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VistasController;
use App\Http\Controllers\PeliculasController;
use App\Http\Controllers\AutenticacionSesionController;


//===RUTAS GET DE CARGA DE VISTAS====//
//Las rutas GET cargan plantillas Blade (las vistas).
//Algunas rutas estan protegidas 'auth' para usuarios logeados
Route::get('/', [VistasController::class, 'index'])
	->name('inicio');

Route::get('/peliculas', [VistasController::class, 'consultaPeliculas'])
	->name('consulta.peliculas');

Route::get('/pelicula/{id}', [VistasController::class, 'consultaPelicula'])
	->name('consulta.pelicula');

Route::get('/pelicula-alta', [VistasController::class, 'altaPelicula'])
	->name('alta.pelicula')
	->middleware('auth');

Route::get('/pelicula-mto/{pelicula}', [VistasController::class, 'mantenimientoPelicula'])
	->name('mantenimiento.pelicula')
	->middleware('auth');



//===RUTAS CRUD (operaciones POST PUT DELETE con BD)====//
//Las rutas POST/PUT/DELETE procesan los datos del formulario (alta, modificación, baja).

Route::post('/pelicula-alta', [PeliculasController::class, 'alta'])
	->name('crud.pelicula.alta')
	->middleware('auth');

Route::put('/pelicula-mto/{pelicula}', [PeliculasController::class, 'modificacion'])
	->name('crud.pelicula.modificacion')
	->middleware('auth');

Route::delete('/pelicula-mto/{pelicula}', [PeliculasController::class, 'baja'])
	->name('crud.pelicula.baja')
	->middleware('auth');



//=====RUTAS DE AUTENTICACION=======//
//carga vista login
Route::get('/login', [AutenticacionSesionController::class, 'vistalogin'])
	->name('vista.login')
	->middleware('guest'); // evita que un user authenticado pueda volver al form de login //OJO DUPLICADO

//solicitud del login al pulsar el boton del formulario
Route::post('/login', [AutenticacionSesionController::class, 'login'])
	->name('login')
	->middleware('guest'); //OJO DUPLICADO

//ruta desconexion
Route::post('/logout', [AutenticacionSesionController::class, 'logout'])
	->name('logout')
	->middleware('auth'); // protege el cierre de session