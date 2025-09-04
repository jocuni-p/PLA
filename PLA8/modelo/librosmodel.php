<?php
require_once('conexion.php');

class LibrosModel extends Database {
	public function consultaLibro($id) {
		//confeccionar la sentencia sql
		$sql = "SELECT * FROM libros WHERE idlibro = $id";

		//trasladar sentencia sql al SGBD
		$resultado = $this->conexion->query($sql);

		//extraer los datos de la reserva del objeto resultante de la consulta
		//fetch_array nos entregara como maximo una fila
		$libro = $resultado->fetch_array(MYSQLI_ASSOC);

		if(!$libro) {
			throw new Exception("Identificador de libro no existe", 404);
		}
		
		return $libro;
	}

	public function consultaLibros() {
		//confeccionar la sentencia sql
		$sql = "SELECT * FROM libros ORDER BY autor,
		 titulo";

		//trasladar sentencia sql al SGBD (Sistema Gestor de la Base de Datos)
		$resultado = $this->conexion->query($sql);

		//extraer los datos de la reserva del objeto resultante de la consulta
		//fetch_all nos entregara todas las filas
		$libros = $resultado->fetch_all(MYSQLI_ASSOC);

		return $libros;
	}

	public function altaLibro($datos) {
		extract($datos);

		//**OPCION A
		//confeccionar la sentencia sql
		// $sql = "INSERT INTO libros (titulo, precio, autor) 
		// VALUES ('$titulo', $precio, '$autor')";

		// //trasladar la sentencia al SGBD
		// $this->conexion->query($sql);

		// return "Libro creado correctamente";
		//=====================================

		//**OPCION B (para escapar los caracteres especiales como "'")
		//preparar la sentencia sql
		$sentencia = $this->conexion->prepare("INSERT INTO 
		reservas (titulo, precio, autor) VALUES (?,?,?)");

		//bind de los valores (s - string; i - integer; d - double; b -blob)
		$sentencia->bind_param("sds", $titulo, $precio, $autor);

		//trasladar la sentencia al SGBD
		$sentencia->execute();

		//recuperar la clave primaria asignada al libro
		$idlibro = $this->conexion->insert_id;

		return "Libro creado correctamente con el numero $idlibro";

	}

	public function modificacionLibro($id, $datos) {

	}

	public function bajaLibro($id) {

	}

}