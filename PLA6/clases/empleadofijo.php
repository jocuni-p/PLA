<?php

require_once 'Empleado.php';

//clase heredera
final class EmpleadoFijo extends Empleado {

	private int $anyAlta;


	public function __construct($nif, $nombre, $edad, $departamento, $anyAlta) {
		//informamos de los atributos comunes con su clase padre
		parent::__construct($nif, $nombre, $edad, $departamento);
		$this->setAnyAlta($anyAlta);
		$this->altaEmpleado(); // llamada a metodo 
	}


	public function getAnyAlta(): int {return $this->anyAlta;}
	public function setAnyAlta($anyAlta): void {
		if (empty($anyAlta) || !is_numeric($anyAlta)) {
			throw new Exception("Any alta no informado o invalido");
		}
		$this->anyAlta = $anyAlta;
	}

	//Implementacion del metodo polimorfico para esta clase
	public function calcularSueldo(): float {
		return self::BASE + (self::COMPLEMENTO * (date("Y") - $this->anyAlta));
	}

	// Ampliacion del metodo de la superclase
	public function mostrarDatos(): string {
		$empleado = parent::mostrarDatos();
		return "$empleado, Fecha de alta: $this->anyAlta";
	}

	private function altaEmpleado() {
		$datosEmp = 'Empleado fijo;' . parent::datosEmpleadoCsv() . ';' . $this->anyAlta;
		//llamada a guardar() que esta en el trait para guardar en empleados.csv
	}
}

?>
