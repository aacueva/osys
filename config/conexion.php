<?php

//Se hará a través de una clase
class Conexion{

	//Atributos...
	private $servidor = "localhost";
	private $basedatos = "chozys";
	private $usuario = "root";
	private $codificacion = "utf8";
	private $clave = "";

	//Método
	public function Conectar(){
		try {

			$cn = new PDO("mysql:host=" . $this->servidor . ";dbname=" . $this->basedatos . ";charset=" . $this->codificacion,$this->usuario,$this->clave);
			return $cn;
		} catch (Exception $e) {
			echo 'Conexion sin exito';
		}
		
	}

}

?>