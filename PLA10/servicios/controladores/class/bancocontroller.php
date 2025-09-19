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

	//HE DE RECUPERAR AQUI EL ARRAY DE LA VARIABLE $_POST ?????

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

			//confeccionamos array de respuesta
			//'00' ens diu que tot ha anat be y podrem netejar el formulari
			return ['codigo' => '00', 'mensajes' => $mensaje, 'datospersona' => $datos];
		}

		public function baja($datos): array {
			$this->validarId($datos['idpersona']);
			$mensaje = $this->banco->baja($datos['idpersona']);
			
			//confeccionamos array de respuesta (no necesita los datospersona porque el formulario debe mostrarse vacio)
			return ['codigo' => '00', 'mensajes' => $mensaje];
		}
		

		public function modificacion($datos):array {
			$this->validarId($datos['idpersona']);
			$this->validarDatos($datos);
			$mensaje = $this->banco->modificacion($datos);

			return ['codigo' => '00', 'mensajes' => $mensaje, 'datospersona' => $datos];
		}
		
		//consulta 1 persona
		public function consulta($datos): array { 
			$this->validarId($datos['idpersona']);
			$persona = $this->banco->consulta($datos['idpersona']);

			return ['codigo' => '00', 'datospersona' => $persona];
		}

		//consulta de todas las personas de la tabla
		public function consultaPersonas() {
			$personas = $this->banco->consultaPersonas();

			return ['codigo' => '00', 'personas' => $personas]; //array de todas las pers del modelo
		}

		//======Metodos auxiliares de validacion=======
		private function validarId($idpersona): int {
//			extract($datos);
			if (empty($idpersona) || !is_numeric($idpersona) || $idpersona <= 0 ) {
				throw new Exception("Se debe seleccionar una persona", 14); //Que codigo es 14??
			}
			return (int)$idpersona;
		}



		private function validarDatos($datos) {
			$errores = '';
			
			//extraccion de datos de forma manual, mas segura
			$nif = $datos['nif'] ?? '';
			$nombre = $datos['nombre'] ?? '';
			$apellidos = $datos['apellidos'] ?? '';
			$direccion = $datos['direccion'] ?? '';
			$telefono = $datos['telefono'] ?? '';
			$email = $datos['email'] ?? '';

			//OJO: HE DE VALIDAR TAMANYOS Y OTROS???????
			if (empty($nif)) $errores .= "Nif obligatorio<br>"; 
			if (empty($nombre))	$errores .= "Nombre obligatorio<br>";
			if (empty($apellidos)) $errores .= "Apellidos obligatorio<br>";
			if (empty($direccion)) $errores .= "Direccion obligatorio<br>";
			if (empty($telefono)) $errores .= "Telefono obligatorio<br>";

			if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$errores .= "Email con formato incorrecto<br>";
			}
			if (!empty($errores)) {
				throw new Exception($errores);
			}
		}

    }
