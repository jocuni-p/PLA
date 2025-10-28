<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutenticacionSesionController extends Controller
{
	//mostrara la vista del formulario de login
    public function vistalogin() {
		$datos['pagina'] = 'Login usuario';
		return view('auth.login')->with($datos);
	}

	//recogera los datos del formulario de login
	public function login(Request $datos) {
		$credenciales = $datos->validate([
			//obligatorio y de tipo email
			'email'		=> ['required', 'email'],
			//obligatorio y de tipo string
			'password'	=> ['required', 'string'] 
		]);

		//recogemos, si lo hay, el contenido del checkbox
		$remember = $datos['remember'] == 'on' ? true : false;

		//classe Auth de Laravel para comprobacion automatica de credenciales
		$login = Auth::attempt($credenciales, $remember);

		//si la comprobacion de credenciales falla, mostraremos 
		//un mensaje de error a traves del fichero de mensajes 
		//de error de Laravel: lang/es/auth.php
		if (!$login) {
			throw \Illuminate\Validation\ValidationException::withMessages([
				'login' => __('auth.failed'),
			]);
		}

		//si el login es correcto regenaramos la 
		//sesion que ya ha iniciado attempt()
		$datos->session()->regenerate();

		//redireccionamos a la url a la que pretendia dirigirse el usuario
		return redirect()->intended('/')->with(['status' => 'Login correcto']);
	}

	//Recuperamos los datos de la sesion del usuario conectado
	public function logout(Request $sesion) {
    // Cerrar sesion del usuario autenticado (proveedor web)
    Auth::guard('web')->logout();

    // Invalidar la sesion actual, iniciada en el proceso de login
    $sesion->session()->invalidate();

    // Regenerar el token CSRF, para que el anterior no se pueda volver a utilizar
    $sesion->session()->regenerateToken();

    // Redirigir al login con un mensaje
    return redirect()->route('vista.login')->with(['status' => 'Usuario desconectado']);
	}
}
