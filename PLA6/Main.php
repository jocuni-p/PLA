<?php

// DEBUG PARA VER LOS ERRORES
ini_set('display_errors', 1);
error_reporting(E_ALL);

	require_once 'clases/empleadofijo.php';
	require_once 'clases/empleadohoras.php';
	require_once 'clases/empleadotemporal.php';

	//DECLARACION/INICIALIZACION VARIABLES
	$datos_fijo = '';
	$sueldo_fijo = null;
	$datos_horas = '';
	$sueldo_horas = null;
	$datos_temporal = '';
	$sueldo_temporal = null;

	//incorporar los namespaces con use (OPCIONAL)

	//quizas convendria un bloque try_catch para cada instanciacion ????
	//INSTANCIA EMPLEADO FIJO
	try {
		$fijo = new EmpleadoFijo('44444444N', 'Alonso Quijano', 'rr', 'Creatividad', '');
		$datos_fijo = $fijo->mostrarDatos();
		$sueldo_fijo = $fijo->calcularSueldo();
	} catch (Exception $error) {
		echo $error->getMessage();
	}

	// INSTANCIA EMPLEADO HORAS
	try {
		$horas = new EmpleadoHoras('77666555F', 'Jaume Canibell', '55', 'Porteria', '120');
		$datos_horas = $horas->mostrarDatos();
		$sueldo_horas = $horas->calcularSueldo();
	} catch (Exception $error) {
		echo $error->getMessage();
	}

	// INSTANCIA EMPLEADO TEMPORAL
	try {
		$temporal = new EmpleadoTemporal('77666555F', 'Placido Alonso', '0', 'Transporte', '30/12/2024', '30/06/2025');
		$datos_temporal = $temporal->mostrarDatos();
		$sueldo_temporal = $temporal->calcularSueldo();
	} catch (Exception $error) {
		echo $error->getMessage();
	}

	//consulta de todos los empleados


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>POO</title>
	<style type="text/css">
		.empleados {width: 500px; padding: 10px; border: 2px solid grey; margin: auto; margin-bottom: 10px; background-color: lightblue;}
		table, td {border: 1px solid grey;margin: auto;padding:5px;}
	</style>
</head>
<body>
	<div class='empleados'>
		<h3>Empleado Fijo</h3>
		<?php
			//mostrar todos los datos del empleado fijo
			echo "<p>$datos_fijo</p>";
			//ejecutar el método de calculo de salario
			echo "<p>Salario: $sueldo_fijo</p>";
		?>
	</div>
	<div class='empleados'>
		<h3>Empleado Horas</h3>
		<?php
			//mostrar todos los datos del empleado horas
			echo "<p>$datos_horas</p>";
			//ejecutar el método de calculo de salario
			echo "<p>Salario: $sueldo_horas</p>";
		?>
	</div>
	<div class='empleados'>
		<h3>Empleado Temporal</h3>
		<?php
			//mostrar todos los datos del empleado temporal
			echo "<p>$datos_temporal</p>";
			//ejecutar el método de calculo de salario
			echo "<p>Salario: $sueldo_temporal</p>";
		?>
	</div>
	<table>
		
	</table>
</body>
</html>