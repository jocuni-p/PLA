<?php
    
	//Recuperamos las rutas de la variable de sesion
	$ruta = $_SESSION['ruta'];
	$servidor = $_SESSION['servidor'];

    //incorporar la clase del controlador y el nombre de espacio asociado a ella
    require_once("$ruta/servicios/controladores/class/bancocontroller.php");   
	use servicios\controladores\class\BancoController;

	//recuperar petición del formulario
	//recuperar el tipo de peticion que se envie desde la vista.
	//Al entrar a la aplicacion desde index.php aun no recibiremos 
	//ninguna peticion asociada al formulario, por eso seteamos a null
	$peticion = $_POST['peticion'] ?? null;


    try {
        //instanciar el controlador
		//instanciamos un obj class BancoContrller para poder acceder a sus metodos
		$banco = new BancoController();

        //recuperar datos de la petición
        $idpersona = trim($_POST['idpersona'] ?? null);
		$nif = trim($_POST['nif'] ?? null);
		$nombre = $_POST['nombre'] ?? null;
		$apellidos = $_POST['apellidos'] ?? null;
		$direccion = $_POST['direccion'] ?? null;
		$telefono = $_POST['telefono'] ?? null;
		$email = $_POST['email'] ?? null;

        //validar petición correcta
		switch ($peticion) {
			case 'alta':
				//OJO: habria que validar lo que nos llega de la vista????
				$respuesta = $banco->alta($nif, $nombre, $apellidos, $direccion, $telefono, $email);
				break;
			case 'consulta':
				//validacion $idpersona  ??????
				$respuesta = $banco->consulta($idpersona);
				break;
			case 'modificacion':
				//validacion datos ?????
				$respuesta = $banco->modificacion($idpersona, $nif, $nombre, $apellidos, $direccion, $telefono, $email);
				break;
			case 'baja':
				//validar $idpersona ?????
				$respuesta = $banco->baja($idpersona);
				break;
		}
        
//    } catch (\Throwable $th) {
	} catch (Exception $e) {
		$respuesta = ['codigo' => $e->getCode(), 'mensajes' => $e->getMessage(), 'datospersona' => $datos];

    }


	//En esta seccion haremos la consulta de todas las personas y las 
	//mostraremos en la tabla inferior de la pagina
    try {
        //enviar siempre el array de personas 
                
        //llamada al método del controlador
		$personas = $banco->consultaPersonas();

//    } catch (\Throwable $th) {
    } catch (Exception $e) {
		$respuesta = ['codigo' => $e->getCode(), 'mensajes' => $e->getMessage()];

    }

    //carga de la vista con los datos de la respuesta
    
    