<?php
	
	//======MODELO=====
	
	//asignacion del namaspace
	namespace servicios\modelos;

	//me aseguro de que las variables de sesion estan activadas
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	
	require_once("$ruta/servicios/modelos/conexion.php");

	//Namespace de las clases que usaremos aqui en el modelo
	use servicios\modelos\utils\metodosComunes;
	use \Exception;
	use \PDO; 
	use \PDOException;

	
	class BancoModel extends Conexion {

		//=====ALTA=====
		public function alta($datos) {
			extract($datos);

			try {
				//preparamos sentencia INSERT
				$sql = "INSERT INTO personas VALUES (NULL, :nif, :nombre, :apellidos, :direccion, :telefono, :email, DEFAULT)";
				//con prepare la lib PDO se encargara de escapar caracteres especiales
				$stmt = $this->conexion->prepare($sql);

				if(empty($email)) {$email = null;} // por si email no viene informado, puesto que no es obligatorio

				//bind de los parametros
				$stmt->bindParam(':nif', $nif);
				$stmt->bindParam(':nombre', $nombre);
				$stmt->bindParam(':apellidos', $apellidos);
				$stmt->bindParam(':direccion', $direccion);
				$stmt->bindParam(':telefono', $telefono);
				$stmt->bindParam(':email', $email);
				
				//ejecutamos
				$stmt->execute();

				return "Persona dada de alta";

			} catch (PDOException $e) { // recoge PDOExceptions
				//recogemos codigo y mensaje de error
				$codigo = $e->errorInfo[1];
				$texto = $e->errorInfo[2]; //para poder saber cual de las UniqueKey es la duplicada
				if ($e->errorInfo[1] == 1062) {
					if (stripos($texto, 'nif')) {
						$clave = 'nif';
					} else {
						$clave = 'email';
					}
				}
				//relanzamos la PDOException para recogerla en Exception
				throw new Exception("No pueden existir dos personas con mismo $clave", $codigo);
			}
		}

		//=====MODIFICACION======
		public function modificacion($datos) {
			extract($datos);
			try {
				//preparacion de la sentencia sql
				$sql = "UPDATE personas SET nif = :nif, nombre = :nombre, 
											apellidos = :apellidos, 
											direccion = :direccion, 
											telefono = :telefono, 
											email = :email 
											WHERE idpersona = :idpersona";

				//escapamos los caracteres especiales
				$stmt = $this->conexion->prepare($sql);

				//si el email (opcional) no viene informado, lo seteamos a null
				if (empty($email)) {
					$email = null;
				}

				//realizar el bind de los parametros
				$stmt->bindParam(':nif', $nif);
				$stmt->bindParam(':nombre', $nombre);
				$stmt->bindParam(':apellidos', $apellidos);
				$stmt->bindParam(':direccion', $direccion);
				$stmt->bindParam(':telefono', $telefono);
				$stmt->bindParam(':email', $email);
				
				//ejecutamos hacia el SGBD
				$stmt->execute();

				//comprobamos si se han modificado datos de alguna fila, si no lanzamos error
				if ($stmt->rowCount() == 0) {
					throw new Exception("Persona no existe o no se han modificado datos", 35);
				}

				return "Persona modificada";

			} catch (PDOException $e) { // recoge exceptions de libreria PDO
				//si lo hay, recogemos codigo y mensaje de error
				$codigo = $e->errorInfo[1];
				$texto = $e->errorInfo[2]; //para poder saber cual de las UniqueKey es la duplicada
				if ($e->errorInfo[1] == 1062) {
					if (stripos($texto, 'nif')) {
						$clave = 'nif';
					} else {
						$clave = 'email';
					}
				}
				//relanzamos la PDOException para recogerla en Exception
				throw new Exception("No pueden existir dos personas con mismo $clave", $codigo);
			}
		}

		//=====BAJA=====
		public function baja($idpersona) {
			try {
				
				//confeccionamos la sentencia y hacemos la peticion/ejecucion
				$sql = "DELETE FROM personas WHERE idpersona = $idpersona";
				$stmt = $this->conexion->query($sql);

				//comprobamos si se ha modificado/borrado datos de alguna fila, si no lanzamos error
				if ($stmt->rowCount() == 0) {
					throw new Exception("Persona no existe", 55);
				}

				return "Persona eliminada";

			} catch (PDOException $e) { // recoge errores de la libreria PDO
				//verificamos que no se haya intentado borrar una persona con cuentas asociadas
				// por que tienen restriccion de clave foranea y no se pueden eliminar
				if ($e->errorInfo[1] == 1451) {
					//relanzamos la PDOException para recogerla en Exception
					throw new Exception("Persona con cuentas asociadas. No se puede eliminar", 20);
				}
				throw new Exception($e->getMessage(), (int)$e->getCode());
			}

		}

		//=====CONSULTA PERSONA======
		public function consulta($idpersona) {
			try {

//				validarId($idpersona);
				
				//preparamos y ejecutamos sentencia (no necesitamos el prepare porque no hay datos que escapar)
				$sql = "SELECT * FROM personas WHERE idpersona = $idpersona";
				$stmt = $this->conexion->query($sql);
				
				//Proteccion: si no se ha actuado sobre ninguna fila lanzamos un error
				if ($stmt->rowCount() == 0) {
					throw new Exception("Persona no existe o se ha dado de baja", 55);
				}
				//especificamos que la respuesta ha de ser un array asociativo
				$stmt->setFetchMode(PDO::FETCH_ASSOC);

				//retorno del array de respuesta con la persona consultada
				return $stmt->fetch();

			} catch (PDOException $e) { // recoge posibles errores de la libreria PDO
				//relanzamos la PDOException para recogerla en Exception
				throw new Exception($e->getMessage(), (int)$e->getCode());
			}
		}

		//======CONSULTA PERSONAS=======
		public function consultaPersonas($datosPaginacion) {
			try {
				extract($datosPaginacion);

				//Calculo del tramo de personas a mostrar en la tabla segun la paginacion
				$filaInicial = ($pagina - 1) * $mostrar;
				//sentencia del tramo de tabla que necesitamos
				$sql = "SELECT * FROM personas ORDER BY nombre, apellidos LIMIT $filaInicial, $mostrar";
				
				$numfilas = "SELECT COUNT(*) as numfilas FROM personas";

				$enlaces = ceil($numfilas/$mostrar);

				return [$personas, $enlaces];
				
			//================ NO LO TENGO CLARO========
				// //ejecutamos la sentencia (aqui no requiere escapar nada, porque no requiere parametros)
				// $sql = "SELECT * FROM personas ORDER BY nombre, apellidos";
				// $stmt = $this->conexion->query($sql);
				// //formato del array de respuesta (array asociativo)
				// $stmt->setFetchMode(PDO::FETCH_ASSOC);
				
				// //==========ESTE TRAMO NO LO ENTIENDO===========
				// //PDOStatement::rowCount() devuelve el num de filas a 
				// //las que afecto la ultima sentencia (p.e. si se borro alguna)
				// if ($stmt->rowCount() == 0) {
				// 	throw new Exception("Persona no existe", 55);
				// }
				// if ($stmt->rowCount() == 0) {
				// 	throw new Exception("Sin datos", 11);
				// }
				// return $stmt->fetchAll();
			//===================

			} catch (PDOException $e) { // recoge posibles errores de la libreria PDO
				// lo relanza con el tipo Exception
				throw new Exception($e->getMessage(), (int)$e->getCode());
			}

		}

		// //=====METODOS VALIDACION PRIVADOS=====

		// private function validarId($idpersona) {
		// 	if (empty($idpersona) || !is_numeric($idpersona) || $idpersona == 0) {
		// 		throw new Exception("Se debe seleccionar una persona", 14);
		// 	}
		// }

	}
?>