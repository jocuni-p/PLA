<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VistasController;
use App\Http\Controllers\PacienteController;


// Route::get('/', function () {
//     return view('home');
// });


//===RUTAS GET DE CARGA DE VISTAS====//
//Las rutas GET cargan plantillas Blade (las vistas).
//Algunas rutas estan protegidas 'auth' para usuarios logeados
Route::get('/', [VistasController::class, 'home'])->name('inicio');

Route::get('/alta', [VistasController::class, 'alta'])->name('vistas.alta');

Route::get('/consulta', [VistasController::class, 'consulta'])->name('vistas.consulta');

Route::get('/mantenimiento', [VistasController::class, 'mantenimiento'])->name('vistas.mantenimiento');


//===RUTAS CRUD (operaciones GET POST PUT DELETE con BD)====//
//Las rutas POST/PUT/DELETE procesan los datos del formulario (alta, modificación, baja).

Route::get('/pacientes', [PacienteController::class, 'consultapacientes'])->name('consultapacientes');

Route::get('/pacientes/{idpaciente}', [PacienteController::class, 'consultapaciente'])->name('consultapaciente');

Route::post('/pacientes', [PacienteController::class, 'alta'])->name('altapaciente');

Route::put('/pacientes/{paciente?}', [PacienteController::class, 'modificacion'])->name('mantenimiento');

Route::delete('/pacientes/{paciente?}', [PacienteController::class, 'baja'])->name('mantenimiento');
