<?php

abstract class Empleado {

	//--------CONSTANTES--------
	//php infiere el tipo automaticamente
	//visibles para las clases herederas
	protected const BASE = 1091.13;
	protected const COMPLEMENTO = 192.95;

	//-------ATRIBUTOS--------
	private string $nif;
	private string $nombre;
	private int $edad;
	private string $departamento;

	//Constructor por delegacion (con setters)
	public function __construct(string $nif, string $nombre, int $edad, string $departamento) {
		$this->setNif($nif);
		$this->setNombre($nombre);
		$this->setEdad($edad);
		$this->setDepartamento($departamento);
	}

	//----GETTERS & SETTERS-----
	public function getNif(): string {return $this->nif;}
	public function getNombre(): string {return $this->nombre;}
	public function getEdad(): int {return $this->edad;}
	public function getDepartamento(): string {return $this->departamento;}

	public function setNif(string $nif): void {
		if (empty($nif) || !preg_match('/^\d{8}[A-Za-z]$/', $nif)) {
			throw new Exception("Nif obligatorio o invalido");
		}
		$this->nif = $nif;
	}
	public function setNombre(string $nombre): void {
		if (empty($nombre) || !preg_match('/^[\p{L}\s\-]+$/u', $nombre)) {
			throw new Exception("Nombre obligatorio o invalido");
		}
		$this->nombre = $nombre;
	}
	public function setEdad(int $edad): void {
		if (empty($edad) || $edad < 18) {
			throw new Exception("Edad obligatoria o invalida");
		}
		$this->edad = $edad;
	}
	public function setDepartamento(string $departamento): void {
		if (empty($departamento)) {
			throw new Exception("Departamento obligatorio");
		}
		$this->departamento = $departamento;
	}

	//-------OTROS METODOS---------
	//metodo abstracto: se implementara en TODAS las classes herederas
	public abstract function calcularSueldo(): float;

	// metodo para mostrar todos los atributos de la clase
	//al usar concatenacion el atributo tipo 'int' se convierte automaticamente a 'string'
	public function mostrarDatos(): string {
		return "Datos empleado: " .
				$this->getNif(). ", " .
				$this->getNombre(). ", " .
				$this->getEdad(). ", " .
				$this->getDepartamento();
	}

	//metodo protected: accesible solo en esta clase y herederas. Retorna datos en formato Csv.
	protected function datosEmpleadoCsv(): string {
		return $this->nif . ';' . $this->nombre . ';' . $this->edad . ';' . $this->departamento;
	}
}
?>
