<?php 
    //FUNCION DE VALIDACION DE DATOS COMUNES  
	function validarDatos($nif, $nombre, $direccion, $personas, $modo = 'alta' ) {

		$errores = [];

		// Validar si el NIF ya existe en la lista (solo en modo 'alta')
    	if ($modo === 'alta' && array_key_exists($nif, $personas)) {
        	$errores[] = 'Esta persona ya existe en la base de datos';
		}

		//Validar si formato de nif es correcto
		if ($nif === '' || !preg_match('/^\d{8}[A-Za-z]$/', $nif)) {
			$errores[] = 'Nif invalido';
		}
		
		//Validar si formato de nombre es correcto
		if ($nombre === '' || !preg_match('/^[\p{L}\s\-]+$/u', $nombre)) {
			$errores[] = 'Nombre invalido';
		}
		
		//Validar direccion
		if ($direccion === '') {
			$errores[] = 'Direccion invalido';
		}
	
		return $errores;
	}
