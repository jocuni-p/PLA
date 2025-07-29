<?php 
    session_start();

	//inicializar el array
	$personas = $_SESSION['personas'] ?? [];

    //compactaremos en un array el array vacio de personas
    $personas = [];

    //Trasladar el contenido del array $personas a la variable de sesión
	$_SESSION['personas'] = $personas;
	$_SESSION['msg'] = '';

    //Retornar a la página principal
	header("Location: ../personas.php");
	exit;
?>