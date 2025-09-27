<?php

use App\Http\Controllers\VistasController;
use Illuminate\Support\Facades\Route;
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

//Asociamos las rutas a un controlador y a un metodo.
//con name() damos un nombre/alias a la ruta para que si hemos de modificar 
//alguna ruta en toda la aplicacion se modificara solo aqui una vez. 
//No es obligatorio usarlo si no queremos.
Route::get('/', [VistasController::class, 'cargarInicio'])->name('ruta.vista.inicio');
Route::get('/peliculas', [VistasController::class, 'cargarPeliculas'])->name('ruta.peliculas');
Route::get('/pelicula/{id}', [VistasController::class, 'cargarPelicula'])->name('ruta.pelicula');
Route::get('/pelicula-alta', [VistasController::class, 'cargarPeliculaAlta'])->name('ruta.pelicula-alta');
Route::get('/pelicula-mto/{id}', [VistasController::class, 'cargarPeliculaMto'])->name('ruta.pelicula-mto');
