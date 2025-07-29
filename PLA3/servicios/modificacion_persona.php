<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

	require_once('funciones/validardatos.php');

	$personas = $_SESSION['personas'] ?? [];
    
	//Recoger los datos (trimados) del formulario
	$nif = trim($_POST['nifModi'] ?? null);
	$nombre = trim($_POST['nombreModi'] ?? null);
	$direccion = trim($_POST['direccionModi'] ?? null);

	//validar datos
	$errores = validarDatos($nif, $nombre, $direccion, $personas, 'modificacion');

	if (empty($errores) && array_key_exists($nif, $personas)) {
		
		//modificar la persona en el array
		$personas[$nif]['nombre'] = $nombre;
		$personas[$nif]['direccion'] = $direccion;

		//Actualizo la var global
		$_SESSION['personas'] = $personas;

		//mensaje de modificación efectuada
		$_SESSION['msg'] = 'Modificacion efectuada';

		//Limpiar errores anteriores
		$_SESSION['errores'] = [];

	} else {
		$_SESSION['errores'] = $errores;
		$_SESSION['msg'] = null;
	}

    //Retornar a la página principal
	header("Location: ../personas.php");
	exit;
?>