<?php 
	//BancoController se encarga de:
	//	-Instanciar obj del modelo BancoController
	//	-Validar datos recibidos de la vista
	//	-Atender las peticiones(alta, baja, modif, consult) del frontcontroller
    
	namespace servicios\controladores\class;

	//me aseguro de que las variables de sesion estan activadas
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

	//Incorporamos el fichero del modelo
	require_once($_SESSION['ruta'] . "/servicios/modelos/bancomodel.php");
	//Incorporamos los namespaces de las clases que usaremos dentro del controlador
	use servicios\modelos\BancoModel;
	use \Exception;

    //definir la clase controlador
	class BancoController {

		private BancoModel $banco;

		// Constructor
		public function __construct() {
			try {
				$this->banco = new BancoModel(); // Instancia obj class BancoModel
			} catch (Exception $e) {
				throw $e; // relanzamos la exception para capturar mas adelante en controlador
			}
		}

		// Metodos publicos
		public function alta($datos): array { //Opcional: especifico el tipo de retorno de function para mejor documentacion 
			$this->validarDatos($datos); // Con 'this' llamo a un metodo de la propia clase
			$mensaje = $this->banco->alta($datos);

			return ['codigo' => '00', 'mensajes' => $mensaje, 'datospersona' => $datos];
		}

		// public function consulta(array);

		// public function baja(array);

		// public function modificacion(array);



		//Metodos private
		private function validarDatos($datos) {
			extract($datos);

			if (empty($nif))
				//$errores deberia ser un string y <br>
				//actuara como salto de linea entre cada error
				$errores .= "Nif obligatorio<br>"; 

			if (empty($nombre))
				$errores .= "Nombre obligatorio<br>";

			if (empty($apellidos))
				$errores .= "Apellidos obligatorio<br>";

			if (empty($direccion))
				$errores .= "Direccion obligatorio<br>";

			if (empty($telefono))
				$errores .= "Telefono obligatorio<br>";

			if (!empty($email)) {
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$errores .= "Email con formato incorrecto<br>";
				}
			}
			if (!empty($errores)) {
				throw new Exception($errores);
			}


		}
    }