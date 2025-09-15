<?php
	//FILE DE ENTRADA A LA APLICACION

	session_start(); // Activa las variables de sesion

	//Variables de sesion para intercambiar datos entre vista y controlador
	$_SESSION['ruta'] = __DIR__;
	$ruta = $_SESSION['ruta']; //ruta a la estructura de carpetas del servidor
	//pwd => /Applications/XAMPP/xamppfiles/htdocs/PLA/PLA10
	//require_once("$ruta/servicios/controladores/frontcontroller.php");

	$_SESSION['personasbanco'] = []; //array de todas las personas a mostrar en la tabla
	$_SESSION['datosbanco'] = []; // guardara los datos del formulario

	// Datos que siempre se inicializan al cargar la aplicacion.
	// $_SESSION['errores'] = [];
	// $_SESSION['nif'] = null;
	// $_SESSION['nombre'] = null;
	// $_SESSION['apellidos'] = null;
	// $_SESSION['direccion'] = null;
	// $_SESSION['telefono'] = null;
	// $_SESSION['email'] = null;
	

	$_SESSION['servidor'] = "http://localhost/PLA/PLA10"; //ruta al servidor
	$servidor = $_SESSION['servidor'];
	//redireccionamos hacia el forntcontroller
	header("Location: $servidor/servicios/controladores/frontcontroller.php");
	exit;
?>