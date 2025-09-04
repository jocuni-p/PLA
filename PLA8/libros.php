<?php
	// Archivo Controlador

	require_once("modelo/librosmodel.php");
	require_once("utils.php");

	//recuperar el tipo de peticion: GET, POST, PUT, DELETE
	$peticion = strtoupper($_SERVER["REQUEST_METHOD"]);

	//recuperar los datos de la peticion que quedan en el fichero 'input' del server
	$datosJSON = file_get_contents('php://input');
	
	//transformamos $datos en JSON a un array asociativo
	//si el json esta vacio, devuelvo un array vacio con ??
	$datos = json_decode($datosJSON, true) ?? [];

	//echo $datosJSON; // DEBUG
    //print_r($datos);

	// recuperar el identificador de recurso a consultar, modificar o borrar
	// este valor llega al server por la url del navegador
	$id = $_GET['id'] ?? null;

	try {
		//instanciamos un obj de la clase del modelo
		$modelo = new LibrosModel();

		//evaluar la peticion
		switch ($peticion) {
			case 'GET': //consulta de reserva
				if ($id) { // consulta de una reserva
					validarId($id);
					$respuesta = $modelo->consultaLibro($id);
				}
				else { //consulta de todas las reservas
					$respuesta = $modelo->consultaLibros();
				}
				break;
			case 'POST':
				validarDatos($datos);
				$respuesta = $modelo->altaLibro($datos);
				break;
			case 'PUT': //modificacion de reserva
				validarId($id);
				validarDatos($datos);
				$respuesta = $modelo->modificacionLibro($id, $datos);
				break;
			case 'DELETE': //baja de reserva
				validarId($id);
				$respuesta = $modelo->bajaLibro($id, $datos);
				break;
			default:
				throw new Exception("Peticion incorrecta", 400);
				break;
		}
		
		header("HTTP/1.1 200");
		//envio de la respuesta en formato json
		echo json_encode(['respuesta' => $respuesta]);


	} catch (Exception $error) {
		//con header enviamos una cabezera con el status de error
		header("HTTP/1.1 {$error->getCode()}");  
		//echo es la respuesta del servidor a la aplicacion que usa la API
		//en un formato json enviamos un array asociativo
		echo json_encode(["error" => $error->getMessage()]);
	}

	
?>