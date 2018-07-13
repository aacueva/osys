<?php

class Marca{

	private $idmarca;
	private $nombremarca;
	

	public function __GET($campo){
		return $this->$campo;
	}

	public function __SET($campo, $valor){
		$this->$campo = $valor;
	}

}

?>