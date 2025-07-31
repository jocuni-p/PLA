<?php

require_once 'Empleado.php'; // superclase
require_once 'traits/GuardarFichero.php'; //trait
require_once 'funciones/validarfecha.php';


//clase heredera y final (no tendra clases herederas)
final class EmpleadoTemporal extends Empleado {

	private const SALARIO_FIJO = 1349.27; // Las constantes NO admiten declaracion de tipo. Php lo infiere automat.
	private string $fechaAlta;
	private string $fechaBaja;

	//trait
	use GuardarFichero;


	public function __construct($nif, $nombre, $edad, $departamento, $fechaAlta, $fechaBaja) {
		//informamos de los atributos comunes con su clase padre
		parent::__construct($nif, $nombre, $edad, $departamento);
		$this->setFechaAlta($fechaAlta);
		$this->setFechaBaja($fechaBaja);
		$this->altaEmpleado();
	}


	public function getFechaAlta(): string {return $this->fechaAlta;}
	public function getFechaBaja(): string {return $this->fechaBaja;}

	public function setFechaAlta($fechaAlta): void {
		if (empty($fechaAlta) || !validarFecha($fechaAlta)) {
			throw new Exception("Fecha de alta: no informado o invalido<br>");
		}
		$this->fechaAlta = $fechaAlta;
	}
	public function setFechaBaja($fechaBaja): void {
		if (empty($fechaBaja) || !validarFecha($fechaBaja)) {
			throw new Exception("Fecha de baja: no informado o invalido<br>");
		}
		$this->fechaBaja = $fechaBaja;
	}


	//Implementacion del metodo polimorfico para esta clase
	public function calcularSueldo(): float {
		return self::SALARIO_FIJO;
	}

	// Ampliacion del metodo de la superclase
	public function mostrarDatos(): string {
		$empleado = parent::mostrarDatos();
		return "$empleado.<br>Periodo trabajado: " . $this->getFechaAlta() . $this->getFechaBaja();
	}

	private function altaEmpleado(): void {
		$datosEmp = 'Empleado temporal;' . parent::datosEmpleadoCsv() . ';' . $this->getFechaAlta() . ';' . $this->getFechaBaja();
//		echo "$datosEmp"; // DEBUG
		$this->guardar($datosEmp); // llamamos al trait como a un metodo de este objeto (this)
	}
}
?>
