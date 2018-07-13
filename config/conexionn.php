<?php

//Se hará a través de una cla
 function Conectar(){
	//Atributos...
	 $servidor = "localhost";
	 $basedatos = "chozys";
	 $usuario = "root";
	 $codificacion = "utf8";
	 $clave = "";

	//Método

		try {

			$cn = new PDO("mysql:host=" . $servidor . ";dbname=" . $basedatos . ";charset=" . $codificacion,$usuario,$clave);
			
		} catch (PDOException $e) {
			echo ':( Conexion sin exito' . $e;
            exit;
        }
		return $cn;
	}


?>