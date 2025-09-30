<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Pelicula;

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

		//=====creo que este scope va al final del metodo======
		//usamos el metodo Validator de Laravel que ya contiene 
		//todos los mensajes de error de validacion necesarios
		$validator = Validator::make($datos, $rules);

		//si hubo algun error en las validaciones vuelve a cargar la 
		//vista de alta con los mismos datos mostrando los mensajes de error
		if ($validator->fails()) { 
			return redirect()->route('alta.pelicula')->withErrors($validator)->withInput(); 
		}
		//====================================================

		//recuperamos los datos de la imagen de portada, si se selecciona,
		//para guardar su nombre en la BD y moverla a la carpeta correspondiente
		if ($imagen) {
			$nombreArchivo = $imagen->getClientOriginalName();

			//averiguamos su peso
			//$pesoArchivo = $imagen->getSize();

		} else { // si no, guardamos la imagen por default 'sinportada'
			$datos['portada'] = 'sinportada.jpg';
		}

		//movemos la imagen seleccionada a su destino 
		//definitivo (/public/img) y le damos un nombre
		Storage::putFileAs('', $imagen, $nombreArchivo);
		//informamos el nombre de la imagen que queremos guardar en la BD
		$datos['portada'] = $nombreArchivo;

/*		
		//si no hubo ningun error en la validacion, la damos de alta en la BD
		//con el modelo 'Pelicula:create' y con este array podremos conservar los
		// datos y volverlos e cargar en la vista
		$datos['pelicula'] = Pelicula::create([
			'titulo'	=> $datos['titulo'],
			'direccion'	=> $datos['direccion'],
			'anio'		=> $datos['anio'],
			'sinopsis'	=> $datos['sinopsis'],
			'img'		=> $datos['portada']
		]);
*/

		////si no hubo ningun error en la validacion, llamamos al metodo 
		//'alta' que tenemos en el modelo 'Pelicula' que creara el alta en la BD.
		//Asignamos los datos del alta al array $datos['pelicula'], para que al
		//volver a cargar la vista, podamos conservarlos.
		$datos['pelicula'] = Pelicula::alta($datos);

		$datos['mensaje'] = 'Alta efectuada';

		//se carga de nuevo la vista con los datos de la pelicula = el mensaje de alta
		//return redirect()->route('alta.pelicula')->with('success', $datos);
		return redirect()->route('alta.pelicula')->withInput()->with('success', $datos);
	}


}
