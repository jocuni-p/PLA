<?php 
    session_start();

	$personas = $_SESSION['personas'] ?? [];

    //Recupero el contenido del atributo name del input 
	$nif = $_POST['nifBaja'] ?? null;

	//validar si el nif esta informado y si se encuentra en el array
	if ($nif && array_key_exists($nif, $personas)) {
       	//borrar la fila del array
		unset($personas[$nif]);
  
		$_SESSION['msg'] = 'Baja efectuada';

	} else {
		$_SESSION['msg'] = 'Este nif no existe en la lista o no llego correctamente';
	}

	$_SESSION['personas'] = $personas;
	
	header("Location: ../personas.php");
	exit;
?>		