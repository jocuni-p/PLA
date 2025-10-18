<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auto;
use App\Models\Categoria;

class VistasController extends Controller
{
    //carga de la vista 'inicio'
	public function index() {
		$datos['pagina'] = 'Vehiculos';
		return view('inicio')->with($datos);
	}

	//carga formulario de alta
	public function altaAuto() {
		$datos['categorias'] = Categoria::consulta();
		$datos['pagina'] = 'Alta de vehiculo';
		return view('auto-alta')->with($datos);
	}

	//listado de peliculas (usa el metodo consulta() del modelo)
	public function consultaAutos() {
		$datos['autos'] = Auto::consulta(); //ordenado por titulo
		$datos['pagina'] = 'Lista de vehiculos';
		
		//'dd' nos muestra en el navegador el contenido de la
		// variable transformada a array
		//dd($datos['autos']->toArray());  // DEBUG

		return view('autos')->with($datos);
	}

	//detalle de un vehiculo
	public function consultaAuto($id) {
		//realizamos la consulta utilizando el modelo Auto
		$auto = Auto::find($id);
		$datos['auto'] = $auto;
		//cargamos la vista de detalle cargando los datos del vehiculo
		$datos['pagina'] = 'Detalle del vehiculo';
    	return view('auto')->with($datos);
	}

	//mantenimiento (recibe el objeto Auto)
	public function mantenimientoAuto(Auto $auto) {
		//consultar todas las categorias de la tabla
		$datos['categorias'] = Categoria::consulta();
		//asignamos el objeto de consulta al array de datos a enviar a la vista
		$datos['auto'] = $auto;
		//cargamos la vista de mantenimiento pasando los datos del vehiculo
		$datos['pagina'] = 'Edicion del vehiculo';
		return view('auto-mto')->with($datos);
	}
}

