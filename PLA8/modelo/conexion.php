<?php

	class Database{

		protected $conexion;

		public function__construct() {
			$this->conexion = new mysqli('localhost', 'root', 'pass', 'biblioteca');
			$this->conexion->set_charset('utf8');
		}



	}