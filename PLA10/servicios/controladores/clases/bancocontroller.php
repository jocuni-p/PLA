<?php 

	//=======CONTROLADOR=======
	//BancoController se encarga de:
	//	-Instanciar obj del modelo BancoController
	//	-Validar datos recibidos de la vista
	//	-Atender las peticiones(alta, baja, modif, consult) del frontcontroller

	namespace servicios\controladores\clases;

	//===DEBUG===
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	//me aseguro de que las variables de sesion estan activadas
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

	//Incorporamos el fichero del modelo
	require_once($_SESSION['ruta'] . "/servicios/modelos/bancomodel.php");
	
	//Incorporamos los namespaces de las clases que usaremos dentro del controlador
	use servicios\modelos\BancoModel;
	use \Exception;

    //CLASSE CONTROLADOR
	class BancoController {

		private BancoModel $banco;

		// Constructor
		public function __construct() {
			try {
				$this->banco = new BancoModel(); // Instancia obj class BancoModel
			} catch (Exception $e) {
				throw $e; // relanzamos la exception para capturar mas adelante
			}
		}

		// =====ALTA====
		public function alta($datos): array {
			$this->validarDatos($datos);
			$mensaje = $this->banco->alta($datos);

			//confeccionamos array de respuesta
			//'00' ens diu que tot ha anat be i podrem netejar el formulari
			return ['codigo' => '00', 'mensajes' => $mensaje, 'datospersona' => $datos];
		}

		// =====BAJA=====
		public function baja($datos): array {
			$this->validarId($datos['idpersona']);
			$mensaje = $this->banco->baja($datos['idpersona']);
			
			//confeccionamos array de respuesta (no necesita los datospersona porque el formulario debe mostrarse vacio)
			return ['codigo' => '00', 'mensajes' => $mensaje];
		}
		
		//=======MODIFICACION=======
		public function modificacion($datos): array {
			$this->validarId($datos['idpersona']);
			$this->validarDatos($datos);
			$mensaje = $this->banco->modificacion($datos);

			return ['codigo' => '00', 'mensajes' => $mensaje, 'datospersona' => $datos];
		}
		
		//=======CONSULTA PERSONA=======
		public function consulta($datos): array { 
			$this->validarId($datos['idpersona']);
			$persona = $this->banco->consulta($datos['idpersona']);

			return ['codigo' => '00', 
					'datospersona' => $persona];
		}

		//=======CONSULTA PERSONAS=========
		public function consultaPersonas($datosPaginacion) {
			$mostrar = $datosPaginacion['mostrar'] ?? 5;
			$pagina = $datosPaginacion['pagina'] ?? 1;

			//El modelo nos devolvera un array con 2 datos (el array de personas
			//consultadas en la tabla y el num de enlaces a confeccionar en la vista),
			//con ambos retornaremos la respuesta al frontcontroller
			$datosConsulta = $this->banco->consultaPersonas($mostrar, $pagina);

			return ['codigo' => '00', 
					'personas' => $datosConsulta[0], 
					'enlaces' => $datosConsulta[1]];
		}

		//======METODOS PRIVATE DE VALIDACION=======//

		private function validarId($idpersona): int {
			if (empty($idpersona) || !is_numeric($idpersona) || $idpersona <= 0 ) {
				throw new Exception("Se debe seleccionar una persona", 14);
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
?>
