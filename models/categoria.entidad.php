<?php

	class Categoria{

		private  $idcategoria;
		private  $nombrecategoria;
		
		public function __GET($campo){
			return $this->$campo;
		}

		public function __SET($campo, $valor){
			$this->$campo = $valor;
		}

	}


?>