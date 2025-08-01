<?php

//idioma por defecto
$idioma = 'es';

$idiomasPermitidos = array('es', 'ca');

//Prioridad:Comprobar si el usuario pulsa en los enlaces de idioma (seleccion por GET) y validar que esta entre los permitidos
if (isset($_GET['idioma']) && in_array($_GET['idioma'], $idiomasPermitidos)) {
	$idioma = $_GET['idioma'];
	// guardar esta configuracion en una cookie por 1 any
	setcookie('idioma', $idioma, time() + (3600 * 24 * 30 * 12), '/');
}
// Segunda prioridad: comprobar si hay cookie de idioma pre-definida y validar que esta entre los idiomas permitidos
elseif (isset($_COOKIE['idioma']) && in_array($_COOKIE['idioma'], $idiomasPermitidos)) {
		$idioma = $_COOKIE['idioma'];
}
// Tercera prioridad: comprobar si hay un idioma predeterminado en el navegador y validar que esta entre permitidos
elseif (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
	$idiomaNavegador=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	if (in_array($idiomaNavegador, $idiomasPermitidos)) {
		$idioma = $idiomaNavegador;
	}
}

//incorporar el fichero que contiene las variables con en el idioma seleccionado
include ("content_secciones/content_$idioma.php");

?>