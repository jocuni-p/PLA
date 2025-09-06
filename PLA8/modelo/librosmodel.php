<?php
	//MODELO PARA TABLA LIBROS
	//CLASE DERIVADA DE Database

require_once('conexion.php');

// No tiene constructor, por tanto, al instanciarla se 
//ejecutara con el constructor de Database (que es quien
// realiza la conexion a la base de datos).
//Si tuviese un constructor, este deberia indicar que se 
//ejecute el construct de su clase parent.

class LibrosModel extends Database {

	public function consultaLibro($id) {
		//confeccionar la sentencia sql
		$sql = "SELECT * FROM libros WHERE idlibro = $id";

		//trasladar sentencia sql al SGBD para que la ejecute
		// y nos devuelve un resultado
		$resultado = $this->conexion->query($sql);

		//extraer los datos de la reserva del objeto resultado de la consulta
		//fetch_array nos entregara UNA fila
		$libro = $resultado->fetch_array(MYSQLI_ASSOC);

		if(!$libro) {
			throw new Exception("Identificador de libro no existe", 404);
		}
		return $libro;
	}

	public function consultaLibros() {
		//confeccionar la sentencia sql
		$sql = "SELECT * FROM libros ORDER BY titulo";

		//trasladar sentencia sql al SGBD (Sistema Gestor de la Base de Datos)
		// y nos devuelve un obj
		$resultado = $this->conexion->query($sql);

		//extraer los datos del objeto resultante de la consulta
		//fetch_all nos entregara TODAS las filas
		$libros = $resultado->fetch_all(MYSQLI_ASSOC);

		return $libros;
	}

	public function altaLibro($datos) {
		extract($datos);

		//**OPCION A
		//confeccionar la sentencia sql
		// $sentencia = "INSERT INTO libros (titulo, precio, autor) 
		// VALUES ('$titulo', $precio, '$autor')";

		// //trasladar la sentencia al SGBD
		// $this->conexion->query($sentencia);

		// return "Libro creado correctamente";
		//=====================================

		//**OPCION B (para escapar el caracter "'" en los VALUES que lo puedan contener
		// y que no perturbe la insercion de la sentencia en la base de datos)
		try {
			//preparar la sentencia sql
			$sentencia = $this->conexion->prepare("INSERT INTO 
			libros (titulo, precio, autor) VALUES (?,?,?)");

			//bind de los valores (s - string; i - integer; d - double; b -blob)
			//Decimos por que valores sustituir los '?'
			$sentencia->bind_param("sds", $titulo, $precio, $autor);

			//trasladar la sentencia al SGBD para que la ejecute
			$sentencia->execute();

			//COMPLEMENTO OPCIONAL
			//recuperar la clave primaria asignada al libro por el SGBD
			$idlibro = $this->conexion->insert_id;

			return "Libro creado correctamente con el numero $idlibro";

		} catch (Exception $error) {
			//Codigo de error de MariaDB cuando se intenta duplicar
			// una clave unica (UK): 1062
			if ($error->getCode() == 1062) {
				throw new Exception("Titulo del libro ya existe", 400);
			}
			//Error indefinido del servidor
			throw new Exception($error->getMessage(), 500);
		}
	}

	public function modificacionLibro($id, $datos) {
		extract($datos);

		try {
			//preparar la sentencia sql
			$sentencia = $this->conexion->prepare("UPDATE libros
			 SET titulo=?, precio=?, autor=? WHERE idlibro = $id");

			//bind de los valores (s - string; i - integer; d - double; b -blob)
			//Decimos por que valores sustituir los '?'
			$sentencia->bind_param("sds", $titulo, $precio, $autor);

			//trasladar la sentencia al SGBD para que la ejecute
			$sentencia->execute();

			//Validar si se ha modificado alguna fila y lanzar una
			// Exception si no se modifico ninguna (libro no existe)
			$numfilas = $this->conexion->affected_rows;
			if (!$numfilas) {
				throw new Exception("Identificador de Libro no existe o no se han modificado datos", 404);
			}
			return "Libro modificado correctamente";
		} catch (Exception $error) {
			//Error indefinido del servidor
			throw new Exception($error->getMessage(), $error->getCode());
		}
	}

	public function bajaLibro($id) {

	}

}