<?php

	//PARA VER ERRORES EN DESARROLLO
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	//INCLUSIONES MANUALES
	require_once 'clases/EmpleadoFijo.php';
	require_once 'clases/EmpleadoHoras.php';
	require_once 'clases/EmpleadoTemporal.php';
	require_once 'clases/Administracion.php';

	//IMPORTAR CLASES CON SU NAMESPACE
	use PLA6\clases\EmpleadoFijo;
	use PLA6\clases\EmpleadoHoras;
	use PLA6\clases\EmpleadoTemporal;
	use PLA6\clases\Administracion;
	use Exception;

	//DECLARACION/INICIALIZACION VARIABLES
	$datos_fijo = '';
	$sueldo_fijo = null;
	$datos_horas = '';
	$sueldo_horas = null;
	$datos_temporal = '';
	$sueldo_temporal = null;
	$empleados = [];


	//INSTANCIA OBJ EMPLEADO FIJO
	try {
		$fijo = new EmpleadoFijo('', 'Alonso Quijano', 56, 'Creatividad', '2022');
		$datos_fijo = $fijo->mostrarDatos();
		$sueldo_fijo = $fijo->calcularSueldo();
	} catch (Exception $error) {
		echo $error->getMessage();
	}

	// INSTANCIA OBJ EMPLEADO HORAS
	try {
		$horas = new EmpleadoHoras('55555555F', 'Jaume Canibell', 55, 'Direccion', '120');
		$datos_horas = $horas->mostrarDatos();
		$sueldo_horas = $horas->calcularSueldo();
	} catch (Exception $error) {
		echo $error->getMessage();
	}

	// INSTANCIA OBJ EMPLEADO TEMPORAL
	try {
		$temporal = new EmpleadoTemporal('66666666T', 'Gabino Quintanilla', 36, 'Marketing', '30/01/2024', '30/06/2025');
		$datos_temporal = $temporal->mostrarDatos();
		$sueldo_temporal = $temporal->calcularSueldo();
	} catch (Exception $error) {
		echo $error->getMessage();
	}

	//consulta de todos los empleados
	$empleados = Administracion::consultaEmpleados();

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
		<p><?= $datos_fijo ?></p>
		<p>Salario: <?= $sueldo_fijo ?></p>
	</div>
	<div class='empleados'>
		<h3>Empleado Horas</h3>
		<p><?= $datos_horas ?></p>
		<p>Salario: <?= $sueldo_horas ?></p>
	</div>
	<div class='empleados'>
		<h3>Empleado Temporal</h3>
		<p><?= $datos_temporal ?></p>
		<p>Salario: <?= $sueldo_temporal ?></p>
	</div>
	<table>
		<?php
			foreach (($empleados ?? []) as $empleado) { 
				echo "<tr>"; // Esto abre una fila HTML en la tabla
				foreach ($empleado as $dato) { 
					echo "<td>$dato</td>"; // Cada dato se imprime como una celda HTML
				}
				echo "</tr>"; // Se cierra la fila HTML
			}
		?>
	</table>
</body>
</html>