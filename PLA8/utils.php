<?php

function validarId($id) {
		if ($id == null || $id == '') {
			throw new Exception("Se debe informar un libro", 400); //codigo de error que devolvera
		}
		//valido que sea un entero positivo
		if (!ctype_digit((string)$id) || (int)$id <= 0) {
			throw new Exception("Identificador de libro no valido", 400);
		}
		return (int)$id;
	}	
	
	
	// Nota: $datos es un array asociativo. Si queremos trabajar mas
	//facilmente podemos convertir las claves asociativas del array en 
	//variables independientes usando extract($datos).

	function validarDatos($datos) {
		$errores = [];
		if (empty($datos['titulo'])) {
			array_push($errores, "Titulo obligatorio");
		}
		if (strlen($datos['titulo']) > 45) {
			array_push($errores, "Titulo demasiado largo (max 45 caracteres)");
		}
		//usare isset() para no confundir 0 con vacio.
		if (!isset($datos['precio']) || !is_numeric($datos['precio'])) {
			array_push($errores, "Precio obligatorio y numerico");
		} else {
			$precio = floatval($datos['precio']);
			if ($precio <= 0 || $precio > 9999.99) {
			array_push($errores, "Precio fuera de rango (1 - 9999.99)");
			}
		}
		if (empty($datos['autor'])) {
			array_push($errores, "Autor obligatorio");
		}
		if (strlen($datos['autor']) > 45) {
			array_push($errores, "Autor demasiado largo (max 45 caracteres)");
		}
		if (!isset($datos['idcategoria']) || !is_numeric($datos['idcategoria'])) {
			array_push($errores, "idcategoria obligatorio y numerico");
		} else {
			if ($datos['idcategoria'] <= 0) {
				array_push($errores, "idcategoria valor invalido");
			}
		}
		if (count($errores)) {
			throw new Exception(implode(';', $errores), 400);
			//implode(): convierte el array $errores en string con un separador de elementos ';'
			// porque Exception espera como primer argumento un string.
		}
	}
