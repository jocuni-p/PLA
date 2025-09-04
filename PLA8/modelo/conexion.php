<?php

	class Database {

		protected $conexion; //para que se pueda acceder solo desde su clase padre

		public function __construct() {
			//para Mac (los parametros los proveera el proveedor de servicios)
			$this->conexion = new mysqli('localhost', 'root', '', 'biblioteca');
			//para Windows
//			$this->conexion = new mysqli('localhost', 'root', '', 'biblioteca');
			$this->conexion->set_charset('utf8');
		}
	}