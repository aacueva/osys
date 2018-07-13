<?php
//VAMOS A TRAER LA CONEXINO A LA BD PARA PODER TRABAJAR	
require_once '../config/conexion.php';

// Define las accciones de la tabla CATEGORIA

class CategoriaModel{
	//Objeto de conexion
	private $pdo;

	public function __CONSTRUCT(){
		try{
			//1. Instaciamos la conecion traemos el metodo Conexion del archivo config en la carpeta config
			$objConexion = new Conexion();

			//2. Asignacion de la conexion al objeto
			$this->pdo = $objConexion->Conectar();

			//3. Atributos de la conectividad
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			}catch(Exception $e){
				die($e->getMessage());	
			}
	}

	public function ListarCategoria(){

		try{
			$resultado = array();

			//Si utilizamos (procedimientos almacenados) se cambia por el CALL
			$tabla = $this->pdo->prepare("SELECT * FROM CATEGORIAS");
			$tabla->execute();

			//Fragmentando: tabla > entidad > array
			foreach ($tabla->fetchAll(PDO::FETCH_OBJ) as $fila) {
				
				// Instancia de la entidad
				$objCategoria = new Categoria();

				//Enviando los valores a la entidad
				$objCategoria->__SET("IDCATEGORIA", $fila->IDCATEGORIA);
				$objCategoria->__SET("NOMBRECATEGORIA", $fila->NOMBRECATEGORIA);
				
				$resultado[] = $objCategoria;
			}
			return $resultado;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function RegistrarCategoria($nombrecategoria){
		try {
			
			$sql = "CALL SPU_INSERTAR_CATEGORIAS(?)";
			$this->pdo->prepare($sql)->execute(array($nombrecategoria));

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function EliminarCategoria($idcategoria){
		try {
			
			$sql = "DELETE FROM CATEGORIAS WHERE IDCATEGORIA = ?";
			$this->pdo->prepare($sql)->execute(array($idcategoria));

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function ModificarCategoria($nombrecategoria, $idcategoria){
		try {
			
			$sql = "CALL SPU_EDITAR_CATEGORIAS (?, ?)";
			$this->pdo->prepare($sql)->execute(array($nombrecategoria, $idcategoria));

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function getDatosCategoria($idcategoria){
		try {
			
			$sql = "SELECT * FROM CATEGORIAS WHERE IDCATEGORIA = ?";
			$resultado = $this->pdo->prepare($sql);
			$resultado->execute(array($idcategoria));
			$registro = $resultado->fetch(PDO::FETCH_OBJ);

			return $registro;
			
		}catch (Exception $e) {
			die($e->getMessage());
		}
	}

}
 ?>