<?php

	//===PRE-CONTROLADOR===

	//me aseguro de que las variables de sesion estan activadas
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

    // Importamos el namespace del controlador antes de cualquier codigo
	use servicios\controladores\class\BancoController;

    //incorporar la clase del controlador y el nombre de espacio asociado a ella
    require_once($_SESSION['ruta'] . "/servicios/controladores/class/bancocontroller.php");   

	//Recuperamos de la var de sesion: ruta de archivos y servidor
	$ruta = $_SESSION['ruta'];
	$servidor = $_SESSION['servidor'];

	//recuperar petición del formulario
	//recuperar el tipo de peticion que se envie desde la vista.
	//Al entrar a la aplicacion desde index.php aun no recibiremos 
	//ninguna peticion asociada al formulario, por eso la seteamos a null
	$peticion = $_POST['peticion'] ?? null;


    try {
        //instanciamos el obj controlador
		//instanciamos un obj class BancoController para poder acceder a sus metodos
		$banco = new BancoController();

        //recuperar datos del formulario (incluyo idpersona en $datos)
        $idpersona = trim($_POST['id'] ?? null);
		$nif = trim($_POST['nif'] ?? null);
		$nombre = $_POST['nombre'] ?? null;
		$apellidos = $_POST['apellidos'] ?? null;
		$direccion = $_POST['direccion'] ?? null;
		$telefono = $_POST['telefono'] ?? null;
		$email = $_POST['email'] ?? null;

		//Compactamos todas las variables en un array asociativo
		//Pasare todo en este array y cada metodo usara solo las variables que necesite 
		$datos = compact('id', 'nif', 'nombre', 'apellidos', 'direccion', 'telefono', 'email');

        //evaluamos la petición correcta, si no hay peticion (null), no deberia evaluarse nada
		switch ($peticion) {
			case 'alta':
				$respuesta = $banco->alta($datos);
				break;
			case 'consulta':
				$respuesta = $banco->consulta($datos);
				break;
			case 'modificacion':
				$respuesta = $banco->modificacion($datos);
				break;
			case 'baja':
				$respuesta = $banco->baja($datos);
				break;
		}
	} catch (Exception $e) { //recogera tanto PDOException como mis propias Exception
		$respuesta = ['codigo' => $e->getCode(),
					'mensajes' => $e->getMessage(),
					'datospersona' => $datos]; //devolvemos los datos para recargar el formulario
	}

	//Creo que aqui deberia guardar $respuesta en las variables de sesion $_SESSION
	// $_SESSION['datosbanco'] = $respuesta ?? [];
	// $_SESSION['personasbanco'] = $personas['personas'] ?? [];

	//consulta de todas las personas para mostrar en la tabla 
    try {
		//recuperamos los datos para la operativa de paginacion: pagina y num personas
		$datosPaginacion['mostrar'] = $_GET['mostrar'] ?? 5; // si no existe sera este por default
		$datosPaginacion['pagina'] = $_GET['pagina'] ?? 1;

		//==================================sin paginacion
        //enviar siempre el array de personas    
        //llamada al método del controlador
		//$personas = $banco->consultaPersonas();
		//===================================

		//enviamos el array con los datos de paginacion y recogemos el array de respuesta
		$datosConsulta = $banco->consultaPersonas($datosPaginacion);


    } catch (Exception $e) {
		$respuesta = ['codigo' => $e->getCode(), 'mensajes' => $e->getMessage()];
    }

	//====================================
	//Guardamos en las variables de sesion los datos para la vista
    //de la respuesta que nos devolvio el metodo consultaPersonas()
    //$_SESSION['personasbanco'] = $personas['personas'] ?? [];
	//respuesta obtenida de los metodos del controlador asociados a cada una de las operativas
	//$_SESSION['datosbanco'] = $respuesta ?? [];
	//=====================================

	//Guardamos en vars de sesion los datos para la vista
	$_SESSION['personasbanco'] = $datosConsulta['personas'] ?? [];
	$_SESSION['paginacion'] = [
		'enlaces' => $datosConsulta['enlaces'],
		'mostrar' => $datosPaginacion['mostrar'],
		'pagina' => $datosPaginacion['pagina']
	];
    
	//redirigimos a la vista del banco.php
	header("Location: $servidor/banco.php");
	exit;
