<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
//use App\Models\Categoria;

class VistasController extends Controller
{
    //carga de la vista 'inicio'
	public function home() {
		//$datos['pagina'] = 'Vehiculos';
		return view('home');//->with($datos);
	}

	//carga formulario de alta
	public function alta() {
		// $datos['categorias'] = Categoria::consulta();
		// $datos['pagina'] = 'Alta de vehiculo';
		return view('alta');//->with($datos);
	}

	//carga el componente de consulta de pacientes
	public function consulta() { //Request $request) {

		// // Recuperamos los filtros desde el formulario (método GET)
    	// $filtro = $request->input('filtro');  // texto de búsqueda por marca
    	// $idcategoria = $request->input('idcategoria'); // id de categoría seleccionada

		// // Llamamos al metodo del modelo pasándole los filtros
		// $datos['autos'] = Auto::consulta($filtro, $idcategoria);

		// // Cargamos todas las categorías para el combo
		// $datos['categorias'] = Categoria::consulta();

		// // Guardamos los filtros para mantenerlos en la vista
		// $datos['filtro'] = $filtro;
		// $datos['idcategoria'] = $idcategoria;
		// $datos['pagina'] = 'Lista de vehículos';

		// //'dd' nos muestra en el navegador el contenido de la
		// // variable transformada a array
		// //dd($datos['autos']->toArray());  // DEBUG
		
		//return view('autos')->with($datos);

		//redireccionamos al metodo de consulta de pacientes del controlador 
		return redirect()->action([PacienteController::class, 'consultapacientes']);

	}

	//detalle de un vehiculo
	// public function consultaAuto($id) {
	// 	//realizamos la consulta utilizando el modelo Auto
	// 	$auto = Auto::find($id);
	// 	$datos['auto'] = $auto;
	// 	//cargamos la vista de detalle cargando los datos del vehiculo

	// 	//recuperar el nombre de la categoría a partir de la clave foránea 
	// 	//que tenemos en la tabla autos
	// 	//a partir de la clave foránea realizaremos una consulta al modelo Categoria
	// 	$auto->categoria = Categoria::find($auto->idcategoria)->nombre;

	// 	$datos['pagina'] = 'Detalle del vehiculo';
    // 	return view('auto')->with($datos);
	// }

	//mantenimiento (recibe el objeto Auto)
	// public function mantenimientoAuto(Auto $auto) {
	// 	//consultar todas las categorias de la tabla
	// 	$datos['categorias'] = Categoria::consulta();
	// 	//asignamos el objeto de consulta al array de datos a enviar a la vista
	// 	$datos['auto'] = $auto;
	// 	//cargamos la vista de mantenimiento pasando los datos del vehiculo
	// 	$datos['pagina'] = 'Edicion del vehiculo';
	// 	return view('auto-mto')->with($datos);
	// }

	//carga el componente del formulario de consulta, baja y modif de paciente
	public function mantenimiento() {

		return view('mantenimiento');
	}
}

