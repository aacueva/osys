<?php
	class Producto{
		private $idproducto;
		private $idcategoria;
		private $idmarca;
		private $descripcion;
		private $precio;
		private $imagen;

		public function __GET($campo){
			return $this->$campo;
		}

		public function __SET($campo, $valor){
			$this->$campo = $valor;
		}

}
?>