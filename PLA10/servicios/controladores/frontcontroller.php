<?php
	//me aseguro de que las variables de sesion estan activadas
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

    // Importamos el namespace del controlador antes de cualquier codigo
	use servicios\controladores\class\BancoController;

	//Recuperamos las rutas de la variable de sesion
	// $ruta = $_SESSION['ruta'];
	$servidor = $_SESSION['servidor'];

    //incorporar la clase del controlador y el nombre de espacio asociado a ella
    require_once($_SESSION['ruta'] . "/servicios/controladores/class/bancocontroller.php");   

	//recuperar petición del formulario
	//recuperar el tipo de peticion que se envie desde la vista.
	//Al entrar a la aplicacion desde index.php aun no recibiremos 
	//ninguna peticion asociada al formulario, por eso seteamos a null
	$peticion = $_POST['peticion'] ?? null;


    try {
        //instanciamos el controlador
		//instanciamos un obj class BancoController para poder acceder a sus metodos
		$banco = new BancoController();

        //recuperar datos del formulario (incluyo idpersona en $datos)
        $idpersona = trim($_POST['idpersona'] ?? null);
		$nif = trim($_POST['nif'] ?? null);
		$nombre = $_POST['nombre'] ?? null;
		$apellidos = $_POST['apellidos'] ?? null;
		$direccion = $_POST['direccion'] ?? null;
		$telefono = $_POST['telefono'] ?? null;
		$email = $_POST['email'] ?? null;

		//Compactamos todas las variables en un array asociativo
		//Pasare todo en este array y cada metodo usara solo las variables que necesite 
		$datos = compact('idpersona', 'nif', 'nombre', 'apellidos', 'direccion', 'telefono', 'email');

        //evaluamos la petición correcta
		//los parametros del array $datos los validaremos en el controller
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


	//En esta seccion hacemos la consulta de todas las personas para
	//mostrar en la tabla inferior de la pagina con el metodo de consulta del controlador
    try {
        //enviar siempre el array de personas    
        //llamada al método del controlador
		$personas = $banco->consultaPersonas();

    } catch (Exception $e) {
		$respuesta = ['codigo' => $e->getCode(), 'mensajes' => $e->getMessage()];
    }

	//Guardamos en sesion los datos para la vista
    //de la respuesta que nos devolvio el metodo consultaPersonas()
    $_SESSION['personasbanco'] = $personas['personas'] ?? [];
	//respuesta obtenida de los metodos del controlador asociados a cada una de las operativas
	$_SESSION['datosbanco'] = $respuesta ?? [];
    
	//redirigimos a la vista personas.php
	//$servidor contiene el path inicial del servidor (recuperado arriba)
	header("Location: $servidor/banco.php");
	exit;
