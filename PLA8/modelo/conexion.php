<?php
	//=====FICHERO DE CONEXION (unico por base de datos)

	class Database {

		protected $conexion; //para que se pueda acceder solo desde su clase padre

		//Instanciamos un obj conexion de la clase mysqli que corresponde 
		// a una de las librerias php que podemos utilizar para acceder a 
		// BBDD relacional como MariaDB/Mysqli
		//Los parametros en el mundo real los proveera el proveedor de 
		//servicios (es posible que la version de XAMMP Mac utilice el pass 'root')
		//	$this->conexion = new mysqli('localhost', 'root', 'root', 'biblioteca');
		public function __construct() {
			$this->conexion = new mysqli('localhost', 'root', '', 'biblioteca');
			$this->conexion->set_charset('utf8');
		}
	}