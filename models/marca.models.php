<?php

require_once '../config/conexion.php';

class MarcaModel{

	private $pdo;

	public function __CONSTRUCT(){
		try {
			
			$objConexion = new Conexion();

			$this->pdo = $objConexion->Conectar();
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function ListarMarca(){
		try {
			
			$resultado = array();

			$tabla = $this->pdo->prepare("SELECT * FROM MARCAS");
			$tabla->execute();

			foreach ($tabla->fetchAll(PDO::FETCH_OBJ) as $fila){
				$objMarca = new Marca();

				$objMarca->__SET("IDMARCA", 		$fila->IDMARCA);
				$objMarca->__SET("NOMBREMARCA", 	$fila->NOMBREMARCA);

				$resultado[] = $objMarca;
			}

			return $resultado;

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}







	public function RegistrarMarca($nombremarca){
		try {

			$sql = "CALL SPU_INSERTAR_MARCAS (?)";
			$this->pdo->prepare($sql)->execute(array($nombremarca));

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function EliminarMarca($idmarca){
		try {
			
			$sql = "DELETE FROM MARCAS WHERE IDMARCA = ? ";
			$this->pdo->prepare($sql)->execute(array($idmarca));

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function ModificarMarca($nombremarca, $idmarca){
		try {
			
			$sql = "CALL SPU_EDITAR_MARCAS (?,?)";
			$this->pdo->prepare($sql)->execute(array($nombremarca, $idmarca));

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getDatosMarca($idmarca){
		try {
			
			$sql = "SELECT * FROM MARCAS WHERE IDMARCA = ?";
			$resultado = $this->pdo->prepare($sql);
			$resultado->execute(array($idmarca));
			$registro = $resultado->fetch(PDO::FETCH_OBJ);

			return $registro;

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

}


?>