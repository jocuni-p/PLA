<?php

require_once 'Empleado.php'; // superclase
require_once 'traits/GuardarFichero.php'; //trait


//clase heredera y final (no tendra clases herederas)
final class EmpleadoFijo extends Empleado {

	private int $anyAlta;

	//trait
	use GuardarFichero;


	public function __construct($nif, $nombre, $edad, $departamento, $anyAlta) {
		//informamos de los atributos comunes con su clase padre
		parent::__construct($nif, $nombre, $edad, $departamento);
		$this->setAnyAlta($anyAlta);
		$this->altaEmpleado(); // llamada a metodo 
	}


	public function getAnyAlta(): int {return $this->anyAlta;}
	public function setAnyAlta($anyAlta): void {
		if (empty($anyAlta) || !is_numeric($anyAlta) || ($anyAlta < 1950 || $anyAlta > 2026)) {
			throw new Exception("Empleado Fijo: Año alta no informado o invalido<br>");
		}
		$this->anyAlta = $anyAlta;
	}

	//Implementacion del metodo polimorfico para esta clase
	public function calcularSueldo(): float {
		return self::BASE + (self::COMPLEMENTO * (date("Y") - $this->getAnyAlta()));
	}

	// Ampliacion del metodo de la superclase
	public function mostrarDatos(): string {
		$empleado = parent::mostrarDatos();
		return "$empleado.<br>Fecha alta: " . $this->getAnyAlta();
	}

	private function altaEmpleado(): void {
		$datosEmp = 'Empleado fijo;' . parent::datosEmpleadoCsv() . ';' . $this->getAnyAlta();
		$this->guardar($datosEmp); // llamamos al trait como a un metodo de este objeto (this)
	}
}
?>
