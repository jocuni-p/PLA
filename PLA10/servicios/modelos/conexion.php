<?php

	//======FICHERO DE CONEXION A BD=======

	//Usaremos la libreria PDO para comunicar con el SGBD
	
	namespace servicios\modelos;

	use \PDO;
	use \PDOException;
	use \Exception;

	class Conexion {
		//constante con los parametros de la conexion
		const DSN = "mysql:host=localhost;dbname=banco;charset=UTF8";

		protected $conexion;

		public function __construct() {
			try {
			//instanciamos obj de conexion de la clase PDO
			$this->conexion = new PDO(self::DSN, 'root', '');
			//activamos captura de excepciones
			$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			} catch (PDOException $e) {
				//capturamos la excepcion PDO y la relanzamos como Exception que capturaremos en el controlador
				throw new Exception($e->getMessage(), $e->getCode());
			}
		}
	}
?>