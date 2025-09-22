<?php

	//===PRE-CONTROLADOR===

	//===DEBUG===
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	//me aseguro de que las variables de sesion estan activadas
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

    // Importamos el namespace del controlador
	use servicios\controladores\clases\BancoController;

    //incorporar la clase del controlador y el nombre de espacio asociado a ella
    require_once($_SESSION['ruta'] . "/servicios/controladores/clases/bancocontroller.php");   

	//Recuperamos de la var de sesion: ruta de archivos y servidor
	$ruta = $_SESSION['ruta'];
	$servidor = $_SESSION['servidor'];

	//recuperar petición del formulario
	//recuperar el tipo de peticion que se envia desde la vista.
	//Al entrar a la aplicacion desde index.php aun no recibiremos 
	//ninguna peticion asociada al formulario, por eso la seteamos a null
	$peticion = $_POST['peticion'] ?? null;


    try {
        //instanciamos el obj controlador
		//instanciamos un obj class BancoController para poder acceder a sus metodos
		$banco = new BancoController();
		
        //recuperar datos del formulario (incluyo idpersona en $datos)
		$idpersona = isset($_POST['idpersona']) ? trim($_POST['idpersona']) : null;
		$nif = isset($_POST['nif']) ? trim($_POST['nif']) : null;
		$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
		$apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : null;
		$direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : null;
		$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : null;
		$email = isset($_POST['email']) ? trim($_POST['email']) : null;

		//Compactamos todas las variables en un array asociativo
		//Pasare todo en este array y cada metodo usara solo las variables que necesite 
		$datos = compact('idpersona', 'nif', 'nombre', 'apellidos', 'direccion', 'telefono', 'email');

        //evaluamos la petición correcta, si no hay peticion (null), no deberia evaluarse nada
		if (!empty($peticion)) {
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
				default:
					$respuesta = ['codigo' => '99', 'mensajes' => 'Peticion no valida'];
			}
		} 
	}catch (Exception $e) { //recogera tanto PDOException como mis propias Exception
		$respuesta = ['codigo' => $e->getCode(),
					'mensajes' => $e->getMessage(),
					'datospersona' => $datos ?? []
					]; //devolvemos los datos para recargar el formulario
	}

	//consulta de todas las personas para mostrar en la tabla 
    try {
		//recuperamos los datos para la operativa de paginacion: pagina y num personas
		$datosPaginacion['mostrar'] = $_GET['mostrar'] ?? 5; // si no existe sera este por default
		$datosPaginacion['pagina'] = $_GET['pagina'] ?? 1;

		//enviamos el array con los datos de paginacion y recogemos el array de respuesta
		$datosConsulta = $banco->consultaPersonas($datosPaginacion);

    } catch (Exception $e) {
		$respuesta = ['codigo' => $e->getCode(), 'mensajes' => $e->getMessage()];
    }

	//Guardamos en vars de sesion los datos para la vista
    //de la respuesta que nos devolvio el metodo consultaPersonas()
	$_SESSION['datosbanco'] = $respuesta ?? [];
	$_SESSION['personasbanco'] = $datosConsulta['personas'] ?? [];
	$_SESSION['paginacion'] = [
		'enlaces' => $datosConsulta['enlaces'] ?? 0,
		'mostrar' => $datosPaginacion['mostrar'],
		'pagina' => $datosPaginacion['pagina']
	];
    
	//redirigimos a la vista del banco.php
	header("Location: $servidor/banco.php");
	exit;
?>
