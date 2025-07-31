<?php

final class Administracion {


	public static function consultaEmpleados():array {
		//Abrir el fichero ficheros/personas.csv en modo lectura.

		//Crear un array vacio para ir guardando una fila 
		//por cada persona que leeremos del fichero.

		//Leemos el fichero linea a linea mientras no lleguemos al final del mismo:
		while (!feof($fichero)) {


		}
		//transformar cada una de las filas del fichero y que se 
		//encuetran en formato csv, en un array escalar:
		$empleado = fgetcsv($fichero, 0, ';');

		//Guardamos cada fila en el array vacio que hemos creado antes
		array_push($empleados, $empleado);

		//retornamos el arry para que lo podemos utilizar en el programa principal
		return $empleados;

	}
}

?>