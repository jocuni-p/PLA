<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;

class VistasController extends Controller
{
    //carga de la vista 'inicio'
	public function index() {
		$datos['pagina'] = 'Peliculas';
		return view('inicio')->with($datos);
	}

	//carga formulario de alta
	public function altaPelicula() {
		$datos['pagina'] = 'Alta de pelicula';
		return view('pelicula-alta')->with($datos);
	}

	//listado de peliculas (usa el metodo consulta() del modelo)
	public function consultaPeliculas() {
		$datos['peliculas'] = Pelicula::consulta(); //ordenado por titulo
		$datos['pagina'] = 'Lista de peliculas';
		
		//'dd' nos muestra en el navegador el contenido de la
		// variable transformada a array
		//dd($datos['peliculas']->toArray());  // DEBUG

		return view('peliculas')->with($datos);
	}

	//detalle de una pelicula
	public function consultaPelicula($id) {
		$pelicula = Pelicula::find($id);
		$datos['pelicula'] = $pelicula;
		$datos['pagina'] = 'Detalle de pelicula';
    	return view('pelicula')->with($datos);
	}

	//mantenimiento (recibe el objeto Pelicula)
	public function mantenimientoPelicula(Pelicula $pelicula) {
		$datos['pelicula'] = $pelicula;
		$datos['pagina'] = 'Edicion de pelicula';
		return view('pelicula-mto')->with($datos);
	}
}

