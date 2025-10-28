<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Paciente;
use Exception;
use Illuminate\Validation\Rule;



class PacienteController extends Controller
{
    
	public function alta(Request $request) {

		//dd($request->all()); //DEBUG
		//recuperar los datos introducidos en el formulario
		$paciente = request()->all();

		//definimos las reglas de validacion para la clase 'Validator'
		$rules = array(
			'nif'			=> 'required|unique:paciente,nif',
			'nombre'		=> 'required',
			'apellidos'		=> 'required',
			'fechaingreso'	=> 'required'
		);

		//opcionalmente, definimos mensajes de validacion asociados a cada regla de arriba
		// $messages = array(
		// 	'nif.required'				=> 'El campo nif es obligatorio',
		// 	'nif.unique'				=> 'El nif ya existe',
		// 	'nombre.required'			=> 'El campo nombre es obligatorio',
		// 	'apellidos.required'		=> 'El campo apellidos es obligatorio',
		// 	'fechaingreso.required'		=> 'Fecha ingreso es obligatoria'
		// );

		//usaremos la clase Validator de Laravel para validar los datos del form
		//$validator = Validator::make($paciente, $rules, $messages);
		$validator = Validator::make($paciente, $rules);

		//La clase Validator nos entregara un array con todos los errores que haya
		if($validator->fails()) {
			dd($validator); //DEBUG
			//si hubo error recargamos la vista con todos sus datos (withinput) y los mensajes de error (obj validator)
			return redirect('alta')
					->withErrors($validator)
					->withinput();
		}

		//Si no hubo ningun error en la validacion de datos, 
		//daremos de alta el paciente en la BD usando el modelo Paciente y
		//asignamos los datos del paciente al array $datos para poder volver a cargarlos en la vista
		// $datos['paciente'] = Paciente::create([
		// 	'nif'			=> $paciente['nif'],
		// 	'nombre'		=> $paciente['nombre'],
		// 	'apellidos'		=> $paciente['apellidos'],
		// 	'fechaingreso'	=> $paciente['fechaingreso'],
		// 	'fechaalta'		=> null
		// ]);
		//MEJOR USAREMOS UN METODO DE ALTA DENTRO DEL MODELO PACIENTE

		//si no hubo ningun error en la validacion, llamamos al metodo 
		//'alta' que tenemos en el modelo 'Paciente' que creara el alta en la BD.
		//Asignamos los datos del paciente al array $datos para conservarlos al
		//volver a cargar la vista.
		$datos['paciente'] = Paciente::alta($paciente);

		$datos['mensajes'] = "Alta efectuada";

		//El usuario permanecera en la vista de alta, con los ultimos datos introducidos,
		//el mensaje de alta y podra dar de alta nuevos usuarios aqui mismo
		return redirect()->route('vistas.alta')->withInput()->with('success', $datos);
	}

	//CONSULTA TODOS
	public function consultapacientes() {
		//recuperamos todos los pacientes utilizando el metodo 
		//del modelo Paciente, que devuelve los pacientes ordenados 
		//por nombre y apellidos
		$datos['pacientes'] = Paciente::consulta();

		//cargamos la vista de consulta pacientes y veremos la tabla
		return view('consulta')->with($datos);
	}

	//CONSULTA UNO
	public function consultapaciente($idpaciente = null) {

		//si no llega ningun paciente, enviaremos mensaje de error
		//y sino realizaremos la consulta utilizando el modelo
		if (!$idpaciente) { 
			$datos['mensajes'] = 'Consulta: Se debe seleccionar un paciente en consulta';
		} else { 
			$datos['paciente'] = Paciente::find($idpaciente); 
		}
		//cargamos de nuevo la vista de mantenimiento pasando los datos del paciente
		return view('mantenimiento')->with($datos);
	}

	//MODIFICACION
	public function modificacion(Request $request, Paciente $paciente) {  //Request $request
		try {

			//recuperamos los datos introducidos en el form
			$datos = request()->all();

			//definimos las reglas de validacion para la clase 'Validator'
		$rules = array(
			//'nif'			=> 'required|unique:paciente,nif,$paciente->idpaciente',
			'nif' 			=> ['required', Rule::unique('paciente')->ignore($paciente->idpaciente, 'idpaciente')],
			'nombre'		=> 'required',
			'apellidos'		=> 'required',
			'fechaingreso'	=> 'required'
		);
		//usamos clase Validator para validar los datos del form
		//$validator = Validator::make($paciente, $rules); ///OJO
		$validator = Validator::make($datos, $rules); 

		//Si falla algo en las validaciones, la clase Validator nos entregara
		// un array con todos los errores que haya
		if($validator->fails()) {
			//dd($validator); //DEBUG
			//si hubo error recargamos la vista con todos sus datos (withinput) y los mensajes de error (obj validator)
			return redirect('mantenimiento')
					->withErrors($validator) //aqui van los errores de validacion
					->withinput();			// aqui van los datos anteriormente introducidos en el form
		}

		//si no hubo ningun error de validacion, trasladamos las
		//validaciones a la BD
		$paciente->update($datos);

		//comprobamos si realmente se ha modificado algun dato
		if(!$paciente->getChanges()) {
			throw new Exception('No se ha modificado ningun dato del paciente');
		}

		//mensaje de exito
		$datos['mensajes'] = "Modificacion efectuada";

		//y mantenemos los datos del paciente en el form
		$datos['paciente'] = $paciente;

		//finalmente, cargamos de nuevo la vista con los datos que queremos mostrar
		return view('mantenimiento')->with($datos);

		} catch (Exception $e ) {
			$datos['mensajes'] = $e->getMessage();
			return view('mantenimiento')->with($datos);
		}
	}

	public function baja(Paciente $paciente) {
		try {
				//validamos que la consulta del paciente devuelve datos,
				//sino informaremos un mensaje en el catch que luego enviaremos a la vista
				if(!$paciente->idpaciente) {
					throw new Exception('Se debe seleccionar un paciente en consulta');
				}

				//con el metodo delete del obj de consulta borramos el paciente de la BD
				$deleted = $paciente->delete();

				//comprobamos si se borro, sino informamos un error
				if(!$deleted) {
					throw new Exception("Error en la baja");
				}

				//si la baja es ok, redirigimos a la vista de consulta con un mensaje de exito
				//return redirect("consulta")->with('success', 'Baja efectuada correctamente');
				return redirect()->route('consultapacientes')->with('success', 'Baja efectuada correctamente');

		
		} catch (Exception	$e) {
			//si hubo algun error permaneceremos en la vista de mantenimiento
			$datos['mensaje'] = $e->getMessage();
			$datos['paciente'] = $paciente; // vuelvo a enviar los datos a la vista
			return view('vistas.mantenimiento')->with($datos);
		}
	}

}
