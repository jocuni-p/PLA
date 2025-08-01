<?php

namespace PLA6\clases;

use Exception;

abstract class Empleado {

	//--------CONSTANTES---------
	// php infiere el tipo de las constantes automaticamente
	// Las hago visibles tambien para las clases herederas
	protected const BASE = 1091.13;
	protected const COMPLEMENTO = 192.95;

	//-------ATRIBUTOS---------
	private string $nif;
	private string $nombre;
	private int $edad;
	private string $departamento;

	//CONSTRUCTOR por delegacion (con setters)
	public function __construct($nif, $nombre, $edad, $departamento) {
		$this->setNif($nif); // Si usamos el setter en el constructor, esta protegido por la exception
		$this->setNombre($nombre);
		$this->setEdad($edad);
		$this->setDepartamento($departamento);
	}

	//----GETTERS & SETTERS-----
	public function getNif(): string {return $this->nif;}
	public function getNombre(): string {return $this->nombre;}
	public function getEdad(): int {return $this->edad;}
	public function getDepartamento(): string {return $this->departamento;}

	public function setNif($nif): void {
		if (empty($nif) || !preg_match('/^\d{8}[A-Za-z]$/', $nif)) {
			throw new Exception("Empleado: Nif obligatorio o invalido<br>");
		}
		$this->nif = $nif;
	}
	public function setNombre($nombre): void {
		if (empty($nombre) || !preg_match('/^[\p{L}\s\-]+$/u', $nombre)) {
			throw new Exception("Empleado: Nombre obligatorio o invalido<br>");
		}
		$this->nombre = $nombre;
	}
	public function setEdad($edad): void {
		if (empty($edad) || !is_numeric($edad) || $edad < 18 || $edad > 70) {
			throw new Exception("Empleado: Edad obligatoria o invalida<br>Edad laboral valida: 18 - 70<br>");
		}
		$this->edad = $edad;
	}
	public function setDepartamento($departamento): void {
		if (empty($departamento)) {
			throw new Exception("Empleado: Departamento obligatorio<br>");
		}
		$this->departamento = $departamento;
	}

	//-------OTROS METODOS---------
	//metodo abstracto/POLIMORFICO. Se implementara distintamente en cada subclase
	public abstract function calcularSueldo(): float;

	// Metodo para mostrar todos los atributos de la clase CON DELEGACION.
	// Este metodo tambien se considera POLIMORFICO porque en las subclases 
	// ampliaremos la logica implantada en esta clase (::parent) con una nueva.
	// Al usar concatenacion el atributo tipo 'int' se convierte automaticamente a 'string'
	public function mostrarDatos(): string {
		return "Datos: " .
				$this->getNif(). ", " .
				$this->getNombre(). ", " .
				$this->getEdad(). ", " .
				$this->getDepartamento() . "<br>";
	}

	//metodo protected: accesible solo en esta clase y herederas. Retorna datos en formato Csv.
	protected function datosEmpleadoCsv(): string {
		return $this->nif . ';' . $this->nombre . ';' . $this->edad . ';' . $this->departamento;
	}
}
?>
