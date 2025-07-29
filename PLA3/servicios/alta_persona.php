<?php 
    session_start();

	require_once('funciones/validardatos.php');
    
	//Recuperamos datos de 'personas' si existe
	$personas = $_SESSION['personas'] ?? [];		

	//Recoger los datos (trimados) del formulario
	$nif = trim($_POST['nif'] ?? null);
	$nombre = trim($_POST['nombre'] ?? null);
	$direccion = trim($_POST['direccion'] ?? null);

	$errores = validarDatos($nif, $nombre, $direccion, $personas, 'alta');

	if (empty($errores)) {
		// Guardar la persona en el array asociativo (clave: NIF)
		$personas[$nif] = [
			'nombre' => $nombre,
			'direccion' => $direccion
		];

		//Actualizo el array 'personas' en la var global
		$_SESSION['personas'] = $personas;

		$_SESSION['msg'] = 'Alta efectuada';

		//Limpiar errores anteriores
		$_SESSION['errores'] = [];

		//Limpiar campos del formulario
		$_SESSION['nif'] = null;
		$_SESSION['nombre'] = null;
		$_SESSION['direccion'] = null;

	} else {
		// En caso de error, guardar los datos para que se repinten en el formulario
		$_SESSION['nif'] = $nif;
		$_SESSION['nombre'] = $nombre;
		$_SESSION['direccion'] = $direccion;
		$_SESSION['errores'] = $errores;
		$_SESSION['msg'] = null; //Limpio el mensaje msg
	}
	
	header("Location: ../personas.php");
	exit;
?>
    