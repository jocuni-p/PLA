<?php

namespace PLA6\clases;

require_once 'Empleado.php'; // superclase
require_once 'traits/GuardarFichero.php'; //trait

use PLA6\clases\Empleado;
use PLA6\traits\GuardarFichero;
use Exception;


//clase heredera y final (no tendra clases herederas)
final class EmpleadoHoras extends Empleado {

	private const PRECIO_HORA = 9.39;
	private int $horastrabajadas;

	//trait
	use GuardarFichero;


	public function __construct($nif, $nombre, $edad, $departamento, $horastrabajadas) {
		//informamos de los atributos comunes con su clase padre
		parent::__construct($nif, $nombre, $edad, $departamento);
		$this->setHorasTrabajadas($horastrabajadas);
		$this->altaEmpleado(); // llamada a metodo propio
	}


	public function getHorasTrabajadas(): int {return $this->horastrabajadas;}

	public function setHorasTrabajadas($horastrabajadas): void {
		if (empty($horastrabajadas) || !is_numeric($horastrabajadas) || ($horastrabajadas <= 0)) {
			throw new Exception("Empleado Horas: Horas trabajadas no informado o invalido<br>");
		}
		$this->horastrabajadas = $horastrabajadas;
	}

	//Implementacion del metodo polimorfico para esta clase
	public function calcularSueldo(): float {
		return self::PRECIO_HORA * $this->getHorasTrabajadas();
	}

	// Ampliacion del metodo de la superclase
	public function mostrarDatos(): string {
		$empleado = parent::mostrarDatos();
		return "$empleado Horas trabajadas: " . $this->getHorasTrabajadas();
	}

	private function altaEmpleado(): void {
		$datosEmp = 'Empleado horas;' . parent::datosEmpleadoCsv() . ';' . $this->getHorasTrabajadas();
		$this->guardar($datosEmp); // llamamos al trait como a un metodo de este objeto (this)
	}
}
?>
