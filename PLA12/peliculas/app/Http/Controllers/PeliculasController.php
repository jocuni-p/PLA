<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Pelicula;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;
use Exception;

class PeliculasController extends Controller
{
	public function alta(Request $request) {
		//recuperamos los datos introducidos en el formulario
		$datos = request()->all();

		//recuperamos el obj con la imagen de portada
		$imagen = $request->file('portada');

		//definimos las reglas de validacion
		$rules = array(
			'titulo'	=> 'required|unique:peliculas,titulo',
			'direccion'	=> 'required',
			'anio'		=> 'required|numeric|min:1900|max:2100',
			'sinopsis'	=> 'required',
			'portada'	=> 'sometimes|image|mimes:jpg,jpeg,png|max:300'
		);

		//validacion
		$validator = Validator::make($datos, $rules);

		//si hubo algun error en las validaciones vuelve a cargar la 
		//vista de alta con los mismos datos mostrando los mensajes de error
		if ($validator->fails()) { 
			return redirect()->route('alta.pelicula')->withErrors($validator)->withInput(); 
		}
		/*
		//procesamiento de la imagen
		if ($imagen) {
			//si se selecciono una imagen
			$nombreArchivo = $imagen->getClientOriginalName();
			//movemos la imagen  a /public/img
			Storage::putFileAs('', $imagen, $nombreArchivo);
			//guardamos el nombre en los datos
			$datos['portada'] = $nombreArchivo;
		} else { 
			// si no se selecciono imagen, usamos la por default 'sinportada'
			$datos['portada'] = 'sinportada.jpg';
		}
		*/

		// procesamiento de la imagen
		if ($imagen) {
			// Método más directo para guardar (usamos time() para darle un prefijo
			//unico a cada imagen de forma que cada portada tenga un mombre unico)
			$nombreArchivo = time() . '_' . $imagen->getClientOriginalName();
			
			//Le decimos a Laravel donde ha de guardar la imagen (/public/img)
			// Guardar usando el método move()
			$imagen->move(public_path('img'), $nombreArchivo);
			
			// Verificar que se guardó correctamente
			if (!file_exists(public_path('img/' . $nombreArchivo))) {
				// Si no se guardó, usar imagen por defecto
				$datos['portada'] = 'sinportada.jpg';
			} else {
				$datos['portada'] = $nombreArchivo;
			}
		} else { 
			$datos['portada'] = 'sinportada.jpg';
		}

		////si no hubo ningun error en la validacion, llamamos al metodo 
		//'alta' que tenemos en el modelo 'Pelicula' que creara el alta en la BD.
		$pelicula = Pelicula::alta($datos);
		
		//Asignamos los datos del alta al array $datos['pelicula'], para que al
		//volver a cargar la vista, podamos conservarlos.

        // Retornamos solo los datos especificos que necesitamos mostrar:
		// de un lado el mensaje de alta y de otro los datos del formulario
        return redirect()->route('alta.pelicula')->with([
                'success' => [
                    'mensaje' => 'Alta efectuada',
					//aqui pasamos un array con los datos, no el objeto
                    'pelicula' => [
						'titulo' => $pelicula->titulo,
                        'direccion' => $pelicula->direccion,
                        'anio' => $pelicula->anio,
                        'sinopsis' => $pelicula->sinopsis,
                        'img' => $pelicula->img
                    ]
                ],
				// Pasamos los datos del formulario por separado
                'form_data' => [
                    'titulo' => $datos['titulo'],
                    'direccion' => $datos['direccion'],
                    'anio' => $datos['anio'],
                    'sinopsis' => $datos['sinopsis']
                ]
            ]);
	}

	public function modificacion(Pelicula $pelicula, Request $request) {

		try{
			//dd("ENTRA en modificacion con id: " . $pelicula->id); // DEBUG
			//recuperamos los datos tipo texto introducidos en el formulario
			$datos = request()->all();
			//recuperamos el fichero seleccionado en el formulario
			$archivo = $request->file('portada');

			//validamos los datos con el metodo validate()
			$request->validate(['titulo'	=> ['required', Rule::unique('peliculas','titulo')->ignore($pelicula->id)],
								'direccion' => ['required'],
								'anio'		=> ['required', 'numeric', 'max:2100', 'min:1900'],
								'sinopsis'	=> ['required'],
								'portada'	=> ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:300'],
			]);

			//si hay fichero(imagen), lo renombramos, lo movemos y lo anyadimos a $datos
			if ($archivo) {
            	$nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
            	$archivo->move(public_path('img'), $nombreArchivo);
            	$datos['portada'] = $nombreArchivo;
        	}
			
			//trasladamos los datos validados a la BD
			$pelicula->update($datos);
			
			//comprobamos si realmente se ha modificado algun dato
			if(!$pelicula->getChanges()) {
				throw new Exception('No se ha modificado ningun dato de la pelicula');
			}
			
			$datos['mensaje'] = "Modificacion efectuada";

			//para mantener los datos de la modifica en el formulario,
			//redireccionamos de nuevo a la ruta de la vista de mantenimiento
			return redirect()
            	->route('mantenimiento.pelicula', [$pelicula->id])
            	->with('success', $datos['mensaje']);

/*		} catch (Exception $e) {
			//asignamos los errores a $datos //quiza seria mejor devolverlos a la vista ?????????
			$datos['mensajes'] = $e->getMessage();	
		} catch (QueryException $e) {
			$datos['mensaje'] = $e->errorInfo[2];
		}   */
		} catch (Exception $e) {
    		return back()->withErrors(['error' => $e->getMessage()]);
		} catch (QueryException $e) {
    		return back()->withErrors(['error' => $e->errorInfo[2]]);
		}
	}
}
