<?php
	//=====FICHERO DE CONEXION A LA BD (unico por base de datos)

	class Database {

		protected $conexion; //para que se pueda acceder solo desde su clase padre

		//Instanciamos un obj conexion de la clase mysqli que corresponde 
		// a una de las librerias php que podemos utilizar para acceder a 
		// BBDD relacional como MariaDB/Mysqli
		//Los parametros en el mundo real los proveera el proveedor de 
		//servicios (es posible que la version de XAMMP Mac utilice el pass 'root')
		//	$this->conexion = new mysqli('localhost', 'root', 'root', 'biblioteca');
		public function __construct() {
			//Con esta linea quiero transformar los errores que entregue el SGBD en
			//excepciones y asi poderlas capturar para tener mas informacion del error
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			
			$this->conexion = new mysqli('localhost', 'root', '', 'biblioteca');
			$this->conexion->set_charset('utf8');
		}

	}