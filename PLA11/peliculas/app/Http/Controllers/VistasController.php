<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;

class VistasController extends Controller
{
    //carga de la vista 'inicio'
	public function index() {
		return view('inicio');
	}

	public function consultaPeliculas() {
		//consulta en la base de datos utilizando el modelo
		//all() en Laravel equivale a la instruccion SQL: SELECT * FROM peliculas 
		//La forma de enviar datos a una vista 
		//tiene que ser mediante un array asociativo
		$datos['peliculas'] = Pelicula::all(); 

		//'dd' nos muestra en el navegador el contenido de la
		// variable transformada a array
//		dd($datos['peliculas']->toArray());  // DEBUG

		return view('peliculas')->with($datos);
	}

	public function consultaPelicula($id) {
		return view('pelicula');
	}

	public function altaPelicula() {
		return view('pelicula-alta');
	}

	public function mantenimientoPelicula($id) {
		return view('pelicula-mto');
	}
}

