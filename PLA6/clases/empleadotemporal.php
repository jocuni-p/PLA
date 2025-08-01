<?php

namespace PLA6\clases;

require_once 'Empleado.php'; // superclase
require_once 'traits/GuardarFichero.php'; //trait
require_once 'funciones/ValidarFecha.php';

use PLA6\clases\Empleado;
use PLA6\traits\GuardarFichero;
use Exception;
use function PLA6\funciones\ValidarFecha;

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
			throw new Exception("Empleado Temporal: Fecha de alta no informada o invalida<br>Formato fecha: dd/mm/yyyy<br>");
		}
		$this->fechaAlta = $fechaAlta;
	}
	public function setFechaBaja($fechaBaja): void {
		if (empty($fechaBaja) || !validarFecha($fechaBaja)) {
			throw new Exception("Empleado Temporal: Fecha de baja no informada o invalida<br>");
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
		return "$empleado Periodo trabajado: " . $this->getFechaAlta() . $this->getFechaBaja();
	}

	private function altaEmpleado(): void {
		$datosEmp = 'Empleado temporal;' . parent::datosEmpleadoCsv() . ';' . $this->getFechaAlta() . ';' . $this->getFechaBaja();
		$this->guardar($datosEmp); // llamamos al trait como si fuese un metodo propio (this)
	}
}
?>
