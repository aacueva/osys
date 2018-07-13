<?php

require_once '../config/conexion.php';


class ProductoModel{

	private $pdo;

	public function __CONSTRUCT(){
		try{

			$objConexion = new Conexion();

			$this->pdo = $objConexion->Conectar();
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function ListarProducto(){
		try{

			$resultado = array();

			$sql = "SELECT * FROM PRODUCTOS";
			$tabla = $this->pdo->prepare($sql);
			$tabla->execute();

			foreach($tabla->fetchAll(PDO::FETCH_OBJ) as $fila){

				$objProducto = new Producto();

				$objProducto->__SET("IDPRODUCTO",	$fila->IDPRODUCTO);
				$objProducto->__SET("IDCATEGORIA",	$fila->IDCATEGORIA);
				$objProducto->__SET("IDMARCA",		$fila->IDMARCA);
				$objProducto->__SET("DESCRIPCION", 	$fila->DESCRIPCION);
				$objProducto->__SET("PRECIO",		$fila->PRECIO);
				$objProducto->__SET("IMAGEN",		$fila->IMAGEN);

				$resultado[] = $objProducto;
			}

			return $resultado;

		}catch(Exception $e){
			die($e->getMessage());
		}
	}

	public function RegistrarProducto($idcategoria, $idmarca, $descripcion, $precio, $imagen){
		try {

			$sql = "CALL SPU_INSERTAR_PRODUCTOS (?,?,?,?,?)";	
			$this->pdo->prepare($sql)->execute(array($idcategoria, $idmarca, $descripcion, $precio, $imagen));

		}catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function EliminarProducto($idproducto){
		try {

			$sql = "DELETE FROM PRODUCTOS WHERE IDPRODUCTO = ?";
			$this->pdo->prepare($sql)->execute(array($idproducto));

		}catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function ModificarProducto($idcategoria, $idmarca, $descripcion, $precio, $imagen, $idproducto){
		try {

			$sql = "CALL SPU_EDITAR_PRODUCTOS (?,?,?,?,?,?)";
			$this->pdo->prepare($sql)->execute(array($idcategoria, $idmarca, $descripcion, $precio, $imagen, $idproducto));

		}catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getDatosProducto($idproducto){
		try {
			
			$sql = "SELECT * FROM PRODUCTOS WHERE IDPRODUCTO = ?";
			$resultado = $this->pdo->prepare($sql);
			$resultado->execute(array($idproducto));
			$registro = $resultado->fetch(PDO::FETCH_OBJ);

			return $registro;
			
		}catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function ListarProductoPA(){
		try{

			$resultado = array();

			$sql = "CALL SPU_LISTAR_PRODUCTOS(1)";
			$tabla = $this->pdo->prepare($sql);
			$tabla->execute();

			foreach($tabla->fetchAll(PDO::FETCH_OBJ) as $fila){

				$objProducto = new Producto();

				$objProducto->__SET("IDPRODUCTO",	$fila->IDPRODUCTO);
				$objProducto->__SET("NOMBRECATEGORIA",	$fila->NOMBRECATEGORIA);
				$objProducto->__SET("NOMBREMARCA",		$fila->NOMBREMARCA);
				$objProducto->__SET("DESCRIPCION", 	$fila->DESCRIPCION);
				$objProducto->__SET("PRECIO",		$fila->PRECIO);
				$objProducto->__SET("IMAGEN",		$fila->IMAGEN);

				$resultado[] = $objProducto;
			}

			return $resultado;

		}catch(Exception $e){
			die($e->getMessage());
		}
	}

}


?>