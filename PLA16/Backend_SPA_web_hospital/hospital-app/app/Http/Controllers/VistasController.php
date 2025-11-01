<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
//use App\Models\Categoria;

class VistasController extends Controller
{
    //carga de la vista 'inicio'
	public function home() {
		return view('home');
	}

	//carga formulario de alta
	public function alta() {
		return view('alta');
	}

	//carga el componente de consulta de pacientes
	public function consulta() {
		//redireccionamos al metodo de consulta de pacientes del controlador 
		return redirect()->action([PacienteController::class, 'consultapacientes']);
	}

	//carga el componente del formulario de consulta, baja y modif de paciente
	public function mantenimiento() {
		return view('mantenimiento');
	}
}

