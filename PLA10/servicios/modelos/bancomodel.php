<?php
	
	//asignacion del namaspace
	namespace servicios\modelos;

	//me aseguro de que las variables de sesion estan activadas
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	
	//OJO: $ruta se vera desde aqui?????????
	require_once("$ruta/servicios/modelos/conexion.php");

	//Namespace de las clases que usaremos aqui en el modelo
	use servicios\modelos\utils\metodosComunes;
	use \Exception;
	use \PDO; 
	use \PDOException;

	//definir la clase modelo
	class BancoModel extends Conexion {

		public function alta($datos) {
			extract($datos);

			try {
				//validacion OJO
				//alta


				//preparamos sentencia INSERT
				$sql = "INSERT INTO personas VALUES (NULL, :nif, :nombre, :apellidos, :direccion, :telefono, :email, DEFAULT)";
				//con prepare la lib PDO se encargara de escapar caracteres especiales
				$stmt = $this->conexion->prepare($sql);

				if(empty($email)) {$email = null;} // por si email no viene informado, puesto que no es obligatorio

				//realizar el bind de los parametros
				$stmt->bindParam(':nif', $nif);
				$stmt->bindParam(':nombre', $nombre);
				$stmt->bindParam(':apellidos', $apellidos);
				$stmt->bindParam(':direccion', $direccion);
				$stmt->bindParam(':telefono', $telefono);
				$stmt->bindParam(':email', $email);
				//$stmt->bindParam(':nif', $nif);  //DEFAULT
				
				$stmt->execute();

				return "Persona dada de alta";

			} catch (PDOException $e) {
				//la relanzamos para incorporarla al tipo Exception
				throw new Exception($e->getMessage(), (int)$e->getCode());

			} catch (Exception $e) {
				//lanzamos el tipo Exception
				throw new Exception($e->getMessage(), $e->getCode());
			}

		}

		public function modificacion($datos) {

		}

		public function baja($idpersona) {

		}
		
		public function consulta($idpersona) {

		}

		public function consultaPersonas() {

		}
	}
?>