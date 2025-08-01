<?php

namespace PLA6\clases;

use Exception;

/** 
 * Esta clase unicamente contiene un metodo estatico publico accesible desde fuera.
 * Retorna un array con los datos del fichero de empleados.csv (1 elemento = 1 empleado).
 */

final class Administracion {

	public static function consultaEmpleados():array {

		//Crear un array
		$arr_empleados = [];

		//Abrir el fichero en modo lectura.
		$fichero = fopen("ficheros/empleados.csv", "r");
		if ($fichero === false) {
			throw new Exception("Error al abrir el fichero 'Empleados' para lectura.");
		}
		//Leer el fichero linea a linea
		while (($empleado = fgetcsv($fichero, 0, ';')) !== false) {
			//Guardamos cada fila en un array 
			array_push($arr_empleados, $empleado); // inserta un nuevo elemento despues del ultimo existente 
	
		}
		fclose($fichero);
				
		return $arr_empleados;
	}
}
?>