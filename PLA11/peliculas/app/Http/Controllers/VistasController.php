<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;

class VistasController extends Controller
{
    //carga de la vista 'inicio'
	public function cargarInicio() {
		return view('inicio');
	}

	public function cargarPeliculas() {
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

	public function cargarPelicula($id) {
		return view('pelicula');
	}

	public function cargarPeliculaAlta() {
		return view('pelicula-alta');
	}

	public function cargarPeliculaMto($id) {
		return view('pelicula-mto');
	}
}

