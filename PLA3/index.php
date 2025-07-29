<?php 
session_start(); // Inicia sesion para guardar los datos de esta sesion

//$_SESSION = []; // DEBUG: ELIMINAR ESTA LINEA PARA TENER PERSISTENCIA HASTA CERRAR EL NAVEGADOR

// Si existe se mantiene igual, si no existe se inicializa vacio []
$_SESSION['personas'] = $_SESSION['personas'] ?? [];

// Datos que siempre se inicializan al cargar la aplicacion.
$_SESSION['errores'] = [];
$_SESSION['msg'] = '';
$_SESSION['nif'] = null;
$_SESSION['nombre'] = null;
$_SESSION['direccion'] = null;

//Redireccion
header("Location: personas.php");
exit;
?>
