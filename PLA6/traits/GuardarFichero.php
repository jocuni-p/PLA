<?php

trait GuardarFichero {
	private function guardar(string $lineatexto_csv): void {
		// abrir en modo Solo escritura. Añade al final. Crea si no existe.
		$fichero = fopen("ficheros/empleados.csv","a");
		if ($fichero === false) {
			throw new Exception("Error al abrir el fichero 'Empleados' modo escritura.");
		}
		// escribo la linea y anyado un salto de linea al final
		if (fwrite($fichero, $lineatexto_csv . PHP_EOL) == false) {
			throw new Exception("Error al escribir en el fichero 'Empleados'.");
		}
		fclose($fichero);
	}
}
?>

