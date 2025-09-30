<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeliculasController extends Controller
{
	public function alta(Request $request) {
		//con el obj Request recuperamos los datos introducidos en el formulario
		$datos = request()->all();

		//recuperamos el obj con la imagen de portada (si no hay ninguno seleccionado sera null)
		$imagen = $request()->file('portada');

		//definimos las reglas de validacion de los datos para la clase Validator de Laravel
		$rules = array(
			'titulo'	=> 'required | unique:peliculas, titulo',
			'direccion'	=> 'required',
			'anio'		=> 'required | numeric | min:1900 | max:2100',
			'sinopsis'	=> 'required',
			'portada'	=> 'image | mimes:jpg, jpeg, png | max:300'
		);

	}
}
