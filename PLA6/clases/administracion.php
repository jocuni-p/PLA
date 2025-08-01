<?php

final class Administracion {


	public static function consultaEmpleados():array {

		//Crear un array para guardar las filas de datos.
		$arr_empleados = [];

		//Abrir el fichero en modo lectura.
		$fichero = fopen("ficheros/empleados.csv", "r");
		if ($fichero === false) {
			throw new Exception("Error al abrir el fichero 'Empleados' para lectura.");
		}

		//Leer el fichero linea a linea
		while (($empleado = fgetcsv($fichero, 0, ';')) !== false) {
			//Guardamos cada fila en un array 
			array_push($arr_empleados, $empleado);
//			array($arr_empleados, $empleado);
		}
		fclose($fichero);
				
		return $arr_empleados;
	}
}

?>