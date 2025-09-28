<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VistasController;
use App\Http\Controllers\PeliculasController;
/*
Route::get('/', function () {
    // vista inicio
    return view('inicio');
});

Route::get('/peliculas', function () {
    return view('peliculas');
});

Route::get('/pelicula/{id}', function ($id) {
    // para ver detalle de una pelicula
    return view('pelicula', ['id' => $id]);
});

Route::get('/pelicula-alta', function () {
    return view('pelicula-alta');
});

Route::get('/pelicula-mto', function () {
    return view('pelicula-mto');
});
*/


//===RUTAS GET DE CARGA DE VISTAS====//
//Las rutas GET cargan plantillas Blade (las vistas).

Route::get('/', [VistasController::class, 'index'])->name('inicio');

Route::get('/peliculas', [VistasController::class, 'consultaPeliculas'])
	->name('consulta.peliculas');

Route::get('/pelicula/{id}', [VistasController::class, 'consultaPelicula'])
	->name('consulta.pelicula');

Route::get('/pelicula-alta', [VistasController::class, 'altaPelicula'])
	->name('alta.pelicula');

Route::get('/pelicula-mto/{pelicula}', [VistasController::class, 'mantenimientoPelicula'])
	->name('mantenimiento.pelicula');



//===RUTAS CRUD (operaciones POST PUT DELETE con BD)====//
//Las rutas POST/PUT/DELETE procesan los datos del formulario (alta, modificación, baja).

Route::post('/pelicula-alta', [PeliculasController::class, 'alta'])
	->name('crud.pelicula.alta');

Route::put('/pelicula-mto/{pelicula}', [PeliculasController::class, 'modificacion'])
	->name('crud.pelicula.modificacion');

Route::delete('/pelicula-mto/{pelicula}', [PeliculasController::class, 'baja'])
	->name('crud.pelicula.baja');