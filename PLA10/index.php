<?php
	//FILE DE ENTRADA A LA APLICACION

	session_start(); // Activa las variables de sesion

	//Creamos la vars de sesion para intercambiar datos entre vista y controlador
	$_SESSION['ruta'] = __DIR__; //pwd
	$ruta = $_SESSION['ruta']; //ruta a la estructura de carpetas del servidor
	
	$_SESSION['servidor'] = "http://localhost/PLA/PLA10"; //ruta al servidor
	$servidor = $_SESSION['servidor'];

	//Inicializamos vars de sesion para: datos formulario y la tabla de personas
	$_SESSION['datosbanco'] = []; // array para datos del formulario
	$_SESSION['personasbanco'] = []; //array para datos tabla inferior

	//Seteamos los datos para la paginacion
	$_SESSION['paginacion'] = [
		'enlaces' => 0,   	//num enlaces por defecto
		'mostrar' => 5,		//num personas a mostrar por defecto
		'pagina' => 1		//pagina inicial por defecto
	];

	//redireccion hacia el forntcontroller
	header("Location: $servidor/servicios/controladores/frontcontroller.php");
	exit;
?>