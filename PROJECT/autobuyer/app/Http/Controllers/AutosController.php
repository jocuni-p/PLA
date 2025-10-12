<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Auto;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;
use Exception;

class AutosController extends Controller
{
	public function alta(Request $request) {
		//recuperamos los datos introducidos en el formulario
		$datos = request()->all();

		//recuperamos el obj con la imagen de portada
		$imagen = $request->file('portada');

		//definimos las reglas de validacion
		$rules = array(
			'marca'			=> 'required',
			'modelo'		=> 'required',
			'precio'		=> 'required|numeric',
			'anio'			=> 'required|numeric|min:2000|max:2050',
			'kilometros'	=> 'required',
			'combustible'	=> 'required',
			'portada'		=> 'sometimes|image|mimes:jpg,jpeg,png|max:300'
		);

		//validacion
		$validator = Validator::make($datos, $rules);

		//si hubo algun error en las validaciones vuelve a cargar la 
		//vista de alta con los mismos datos mostrando los mensajes de error
		if ($validator->fails()) { 
			return redirect()->route('alta.auto')->withErrors($validator)->withInput(); 
		}

		// procesamiento de la imagen
		if ($imagen) {
			// Metodo mas directo para guardar. Usamos time() para darle un prefijo
			//unico a cada imagen de forma que cada portada tenga un mombre unico.
			$nombreArchivo = time() . '_' . $imagen->getClientOriginalName();
			
			//Le decimos a Laravel donde ha de guardar la imagen (/public/img)
			// Guardar usando el método move()
			$imagen->move(public_path('img'), $nombreArchivo);
			
			// Verificar que se guardo correctamente
			if (!file_exists(public_path('img/' . $nombreArchivo))) {
				// Si no se guardo, usar imagen por defecto
				$datos['portada'] = 'sinportada.jpg';
			} else {
				$datos['portada'] = $nombreArchivo;
			}
		} else { 
			$datos['portada'] = 'sinportada.jpg';
		}

		////si no hubo ningun error en la validacion, llamamos al metodo 
		//'alta' que tenemos en el modelo 'Auto' que creara el alta en la BD.
		$auto = Auto::alta($datos);
		
		//Asignamos los datos del alta al array $datos['auto'], para que al
		//volver a cargar la vista, podamos conservarlos.

        // Retornamos solo los datos especificos que necesitamos mostrar:
		// de un lado el mensaje de alta y de otro los datos del formulario
        return redirect()->route('alta.auto')->with([
            'success' => [
                'mensaje' => 'Alta efectuada',
				//aqui pasamos un array con los datos, no el objeto
               	'auto' 				=> [
					'marca' 		=> $auto->marca,
                   	'modelo' 		=> $auto->modelo,
					'precio' 		=> $auto->precio,
                   	'anio' 			=> $auto->anio,
					'kilometros'	=> $auto->kilometros,
                   	'combustible'	=> $auto->combustible,
                   	'img' 			=> $auto->img
               	]
           	],
			// Pasamos los datos del formulario por separado
			'form_data' 		=> [
                'marca' 		=> $datos['marca'],
				'modelo' 		=> $datos['modelo'],
				'precio' 		=> $datos['precio'],
                'anio'			=> $datos['anio'],
				'kilometros' 	=> $datos['kilometros'],
				'combustible'	=> $datos['combustible']
            ]
        ]);
	}

	public function modificacion(Auto $auto, Request $request) {
		try{
			//dd("ENTRA en modificacion con id: " . $auto->id); // DEBUG
			
			//recuperamos los datos tipo texto introducidos en el formulario
			$datos = request()->all();
			//recuperamos el fichero seleccionado en el formulario
			$archivo = $request->file('portada');

			//validamos los datos con el metodo validate()
			$request->validate(['marca'			=> ['required', Rule::unique('autos','marca')->ignore($auto->id)],
								'modelo' 		=> ['required'],
								'precio'		=> ['required|numeric'],
								'anio'			=> ['required', 'numeric', 'max:2050', 'min:2000'],
								'kilometros'	=> ['required'],
								'combustible'	=> ['required'],
								'portada'		=> ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:300']
			]);

			if ($archivo) {
				// Guardamos el nombre de la imagen anterior
				$imagenAnterior = $auto->img;

				// Renombramos y movemos la nueva imagen
				$nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
				$archivo->move(public_path('img'), $nombreArchivo);
				$datos['img'] = $nombreArchivo;

				// Borramos la imagen anterior si no es la por defecto
				if ($imagenAnterior && $imagenAnterior != 'sinportada.jpg') {
					$rutaImagenAnterior = public_path('img/' . $imagenAnterior);
					if (file_exists($rutaImagenAnterior)) {
						unlink($rutaImagenAnterior); // borrado físico del archivo
					}
				}
			} else {
				// Si no se sube imagen, conservamos la actual
				$datos['img'] = $auto->img ?? 'sinportada.jpg';
			}	

			//trasladamos los datos validados a la BD
			$auto->update($datos);
			
			//comprobamos si realmente se ha modificado algun dato
			if(!$auto->getChanges()) {
				throw new Exception('No se ha modificado ningun dato del vehículo');
			}
			
			$datos['mensaje'] = "Modificacion efectuada";

			//para mantener los datos de la modifica en el formulario,
			//redireccionamos de nuevo a la ruta de la vista de mantenimiento
			return redirect()
            	->route('mantenimiento.auto', [$auto->id])
            	->with('success', $datos['mensaje']);

		} catch (Exception $e) {
    		return back()->withErrors(['error' => $e->getMessage()]);
		} catch (QueryException $e) {
    		return back()->withErrors(['error' => $e->errorInfo[2]]);
		}
	}

	public function baja(Auto $auto) {
		try {
			// Guardamos el nombre de la imagen antes de borrar el registro
			$nombreImagen = $auto->img;

			// Borramos el vehículo de la base de datos
			$deleted = $auto->delete();

			// Si se borró y la imagen no es la por defecto, borramos el archivo
			if ($deleted && $nombreImagen != 'sinportada.jpg') {
				$imagenPath = public_path('img/' . $nombreImagen);
				if (file_exists($imagenPath)) {
					unlink($imagenPath); // borrado fisico del archivo
				}
			}

			// Redirigimos al listado de vehículos con mensaje de éxito
			return redirect()->route('consulta.autos')->with('success', 'Vehículo eliminado correctamente');

		} catch (Exception $e) {
			return back()->withErrors(['error' => $e->getMessage()]);
		} catch (QueryException $e) {
			return back()->withErrors(['error' => $e->errorInfo[2]]);
		}
	}

}
